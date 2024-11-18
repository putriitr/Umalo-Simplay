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
    public function index()
    {
        // Mengambil semua Proforma Invoices dengan relasi ke PurchaseOrder dan User
        $proformaInvoices = ProformaInvoice::with('purchaseOrder', 'purchaseOrder.user')->get();
        return view('Admin.ProformaInvoice.index', compact('proformaInvoices'));
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
            'pi_number' => 'required|unique:proforma_invoices',
            'pi_date' => 'required|date',
            'dp' => 'nullable|numeric|min:0|max:100', // Validasi DP sebagai persentase
            'vendor_name' => 'required|string',
            'vendor_address' => 'required|string',
            'vendor_phone' => 'required|string',
            'products' => 'required|array',
        ]);
        $purchaseOrder = PurchaseOrder::with('quotation', 'user')->findOrFail($purchaseOrderId);
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
        $piNumberFormatted = sprintf("%s/PI-AGS-%s/%s/%s", $request->pi_number, $singkatanNamaPerusahaan, $tanggalRomawi, $tahun);

        


        // Buat Proforma Invoice
        $proformaInvoice = ProformaInvoice::create([
            'purchase_order_id' => $purchaseOrderId,
            'pi_number' => $request->pi_number,
            'pi_date' => $request->pi_date,
            'subtotal' => $request->subtotal,
            'ppn' => $request->ppn,
            'grand_total_include_ppn' => $request->grand_total_include_ppn,
            'dp' => $dpAmount, // Simpan nominal DP
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
}