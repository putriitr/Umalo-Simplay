<?php

namespace App\Http\Controllers\Admin\ProformaInvoice;

use App\Http\Controllers\Controller;
use App\Models\ProformaInvoice;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class ProformaInvoiceAdminController extends Controller
{
    public function show($id)
    {
        // Temukan Proforma Invoice berdasarkan ID
        $proformaInvoice = ProformaInvoice::with('purchaseOrder.user')->findOrFail($id);

        // Kirim data ke view
        return view('Admin.ProformaInvoice.show', compact('proformaInvoice'));
    }
    public function index(Request $request)
    {
        // Ambil keyword pencarian dari input pengguna
        $keyword = $request->input('search');

        // Query Proforma Invoices dengan pencarian dan pagination
        $proformaInvoices = ProformaInvoice::with('purchaseOrder', 'purchaseOrder.user')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('pi_number', 'like', "%{$keyword}%")
                    ->orWhereHas('purchaseOrder', function ($q) use ($keyword) {
                        $q->where('po_number', 'like', "%{$keyword}%")
                            ->orWhereHas('user', function ($qUser) use ($keyword) {
                                $qUser->where('name', 'like', "%{$keyword}%");
                            });
                    });
            })
            ->paginate(10); // Menampilkan 10 item per halaman

        return view('Admin.ProformaInvoice.index', compact('proformaInvoices', 'keyword'));
    }

    // Menampilkan form untuk membuat Proforma Invoice
    public function create($purchaseOrderId)
    {
        $purchaseOrder = PurchaseOrder::with('quotation.quotationProducts')->findOrFail($purchaseOrderId);

        // Mengisi subtotal, ppn, dan grand_total_include_ppn berdasarkan data quotation
        $quotation = $purchaseOrder->quotation;
        $subtotal = $quotation->subtotal_price;
        $ppn = $quotation->ppn;
        $grandTotalIncludePPN = $quotation->total_after_discount + ($quotation->total_after_discount * ($ppn / 100));
        // Ambil data user terkait untuk mengisi vendor information
        $user = $purchaseOrder->user;

        // Mendapatkan daftar produk dari quotation_products
        $products = $quotation->quotationProducts->map(function ($product) {
            return [
                'description' => $product->equipment_name,
                'qty' => $product->quantity,
                'unit' => $product->merk_type,
                'unit_price' => $product->unit_price,
            ];
        });

        return view('Admin.ProformaInvoice.create', compact('purchaseOrder', 'subtotal', 'ppn', 'grandTotalIncludePPN', 'products', 'user'));
    }


    // Menyimpan Proforma Invoice ke database dan generate PDF
    public function store(Request $request, $purchaseOrderId)
    {
        $request->validate([
            'installments' => 'required|integer|min:1',
            'dp' => 'nullable|numeric|min:0|max:100', // Validasi DP sebagai persentase
            'vendor_name' => 'required|string',
            'vendor_address' => 'required|string',
            'vendor_phone' => 'required|string',
            'products' => 'required|array',
        ]);
        $purchaseOrder = PurchaseOrder::with('quotation', 'user')->findOrFail($purchaseOrderId);
        // Ambil nomor terakhir dari Proforma Invoice
        $lastPiNumber = ProformaInvoice::max('id'); // Ambil ID terakhir sebagai dasar increment
        $nextPiNumber = str_pad($lastPiNumber + 1, 3, '0', STR_PAD_LEFT); // Format dengan leading zero (001, 002, ...)

        // Format PI Number untuk Database
        $piFormatted = sprintf("%s", $nextPiNumber); // Format sederhana, hanya angka increment

        // Ambil grand total dari quotation
        $grandTotalIncludePPN = $purchaseOrder->quotation->total_after_discount + ($purchaseOrder->quotation->total_after_discount * ($purchaseOrder->quotation->ppn / 100));

        // Hitung DP dalam nominal berdasarkan grand_total_include_ppn
        $dpPercent = $request->dp;
        $dpAmount = ($dpPercent / 100) * $grandTotalIncludePPN;
        // Ambil singkatan nama perusahaan dari user terkait
        $namaPerusahaan = $purchaseOrder->user->nama_perusahaan ?? 'Perusahaan';
        $singkatanNamaPerusahaan = strtoupper(implode('', array_filter(array_map(function ($kata) {
            return $kata !== 'PT' ? $kata[0] : ''; // Hindari "PT" dari singkatan
        }, explode(' ', $namaPerusahaan)))));

        // Gunakan tanggal hari ini untuk konversi angka Romawi dan tahun
        $today = now();
        $romanNumbers = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII', 'XIII', 'XIV', 'XV', 'XVI', 'XVII', 'XVIII', 'XIX', 'XX', 'XXI', 'XXII', 'XXIII', 'XXIV', 'XXV', 'XXVI', 'XXVII', 'XXVIII', 'XXIX', 'XXX', 'XXXI'];
        $tanggalRomawi = $romanNumbers[$today->day - 1];
        $tahun = $today->year;

        // Format Nomor PO dan PI dengan format yang diminta
        $poNumberFormatted = sprintf("%s/SPO/%s/%s/%s", $purchaseOrder->po_number, $singkatanNamaPerusahaan, $tanggalRomawi, $tahun);
        $piNumberFormatted = sprintf("%s/PI-SIMPLAY-%s/%s/%s", $piFormatted, $singkatanNamaPerusahaan, $tanggalRomawi, $tahun);


        // Buat Proforma Invoice
        $proformaInvoice = ProformaInvoice::create([
            'purchase_order_id' => $purchaseOrderId,
            'pi_number' => $piFormatted, // Simpan nomor sederhana di database
            'pi_date' => now(), // Tanggal otomatis
            'subtotal' => $request->subtotal,
            'ppn' => $request->ppn,
            'grand_total_include_ppn' => $request->grand_total_include_ppn,
            'dp' => $dpAmount, // Simpan nominal DP
            'installments' => $request->installments,
        ]);

        // Generate PDF
        $pdf = PDF::loadView('Admin.ProformaInvoice.pdf', [
            'proformaInvoice' => $proformaInvoice,
            'purchaseOrder' => $proformaInvoice->purchaseOrder,
            'vendorName' => $request->vendor_name,
            'vendorAddress' => $request->vendor_address,
            'vendorPhone' => $request->vendor_phone,
            'products' => $request->products,
            'dpPercent' => $dpPercent,  // Kirim $dpPercent ke view PDF
            'poNumberFormatted' => $poNumberFormatted,
            'piNumberFormatted' => $piNumberFormatted,

        ]);

        // Buat nama file PDF
        $filename = time() . '_' . Str::slug('Proforma_Invoice_' . $proformaInvoice->id) . '.pdf';
        $path = public_path('pdfs/' . $filename);

        // Pastikan folder penyimpanan ada
        if (!File::exists(public_path('pdfs'))) {
            File::makeDirectory(public_path('pdfs'), 0755, true);
        }

        // Simpan PDF ke path yang ditentukan
        $pdf->save($path);

        // Simpan path file di database
        $proformaInvoice->update(['file_path' => 'pdfs/' . $filename]);

        return redirect()->route('admin.proforma-invoices.index')->with('success', 'Proforma Invoice created and PDF generated successfully.');
    }
    public function approveRejectPayment(Request $request, $id)
    {
        $request->validate([
            'remarks' => 'nullable|string|max:500',
            'action' => 'required|in:approve,reject',
        ]);
    
        $proformaInvoice = ProformaInvoice::findOrFail($id);
    
        if ($request->action === 'approve') {
            $proformaInvoice->payments_completed++;
            $proformaInvoice->last_payment_status = 'approved';
    
            if ($proformaInvoice->payments_completed >= $proformaInvoice->installments) {
                $proformaInvoice->status = 'paid'; // Tandai sebagai paid jika semua pembayaran selesai
            } else {
                $proformaInvoice->status = 'partially_paid'; // Tandai sebagai partially_paid jika masih ada pembayaran
            }
        } elseif ($request->action === 'reject') {
            $proformaInvoice->last_payment_status = 'rejected';
        }
    
        $proformaInvoice->remarks = $request->input('remarks');
        $proformaInvoice->save();
    
        return redirect()->back()->with('success', 'Pembayaran berhasil ' . ($request->action === 'approve' ? 'disetujui' : 'ditolak') . '.');
    }
    
}

