<?php
namespace App\Http\Controllers\Admin\Invoice;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\ProformaInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class InvoiceAdminController extends Controller
{
    public function show($id)
    {
        $invoice = Invoice::with('proformaInvoice.purchaseOrder')->findOrFail($id);
        return view('Admin.Invoice.show', compact('invoice'));
    }
    public function index()
    {
        $invoices = Invoice::with('proformaInvoice')->get();
        return view('Admin.Invoice.index', compact('invoices'));
    }
    public function create($proformaInvoiceId)
    {
        // Ambil data Proforma Invoice dan relasi terkait seperti Purchase Order
        $proformaInvoice = ProformaInvoice::with('purchaseOrder')->findOrFail($proformaInvoiceId);

        // Ambil subtotal, ppn, dan grand_total dari proforma invoice untuk ditampilkan di form
        $subtotal = $proformaInvoice->subtotal;
        $ppn = $proformaInvoice->ppn;
        $grandTotalIncludePPN = $proformaInvoice->grand_total_include_ppn;

        // Ambil data user dari Purchase Order untuk mengisi informasi vendor otomatis
        $user = $proformaInvoice->purchaseOrder->user;

        // Tampilkan form create dengan data yang sudah disiapkan
        return view('Admin.Invoice.create', compact('proformaInvoice', 'subtotal', 'ppn', 'grandTotalIncludePPN', 'user'));
    }

    public function store(Request $request, $proformaInvoiceId)
    {
        // Validasi input
        $request->validate([
            'invoice_number' => 'required|unique:invoices',
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date',
            'vendor_name' => 'required|string',
            'vendor_address' => 'required|string',
            'vendor_phone' => 'required|string',
        ]);
        // Ambil Proforma Invoice terkait
        $proformaInvoice = ProformaInvoice::with('purchaseOrder.user')->findOrFail($proformaInvoiceId);
        // Dapatkan nama perusahaan dan buat singkatan nama
        $namaPerusahaan = $proformaInvoice->purchaseOrder->user->nama_perusahaan ?? 'Perusahaan';
        $singkatanNamaPerusahaan = strtoupper(implode('', array_filter(array_map(function ($kata) {
            return $kata !== 'PT' ? $kata[0] : ''; // Hindari "PT" dari singkatan
        }, explode(' ', $namaPerusahaan)))));
        // Konversi tanggal menjadi Romawi dan ambil tahun
        $tanggalRomawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII', 'XIII', 'XIV', 'XV', 'XVI', 'XVII', 'XVIII', 'XIX', 'XX', 'XXI', 'XXII', 'XXIII', 'XXIV', 'XXV', 'XXVI', 'XXVII', 'XXVIII', 'XXIX', 'XXX', 'XXXI'];
        $hariIni = \Carbon\Carbon::now();
        $dayRoman = $tanggalRomawi[$hariIni->day - 1];
        $tahun = $hariIni->year;
        // Format nomor PO dan nomor Invoice
        $poNumberFormatted = sprintf("%s/SPO/%s/%s/%s", $proformaInvoice->purchaseOrder->po_number, $singkatanNamaPerusahaan, $dayRoman, $tahun);
        $piNumberFormatted = sprintf("%s/INV-SIMPLAY-%s/%s/%s", $request->invoice_number, $singkatanNamaPerusahaan, $dayRoman, $tahun);

        // Buat data invoice dan simpan ke database
        $invoice = Invoice::create([
            'proforma_invoice_id' => $proformaInvoice->id,
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'subtotal' => $proformaInvoice->subtotal,
            'ppn' => $proformaInvoice->ppn,
            'grand_total_include_ppn' => $proformaInvoice->grand_total_include_ppn,
        ]);
        // Generate PDF dengan data invoice yang baru saja dibuat
        $pdf = PDF::loadView('Admin.Invoice.pdf', [
            'invoice' => $invoice,
            'proformaInvoice' => $proformaInvoice,
            'vendor_name' => $request->vendor_name,
            'vendor_address' => $request->vendor_address,
            'vendor_phone' => $request->vendor_phone,
            'poNumberFormatted' => $poNumberFormatted,  // Kirim format nomor PO ke view
            'piNumberFormatted' => $piNumberFormatted,  // Kirim format nomor Invoice ke view
        ]);
        // Buat nama file unik dan simpan PDF ke direktori publik
        $filename = time() . '_' . Str::slug('Invoice_' . $invoice->invoice_number) . '.pdf';
        $path = 'pdfs/invoices/' . $filename;
        // Pastikan direktori `pdfs/invoices` tersedia
        if (!File::exists(public_path('pdfs/invoices'))) {
            File::makeDirectory(public_path('pdfs/invoices'), 0755, true, true);
        }
        // Simpan PDF ke path yang ditentukan
        $pdf->save(public_path($path));
        // Update path file di record invoice
        $invoice->update(['file_path' => $path]);
        return redirect()->route('invoices.index')->with('success', 'Invoice created and PDF generated successfully.');
    }


}