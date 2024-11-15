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
    
        // Tampilkan form create dengan data yang sudah disiapkan
        return view('Admin.Invoice.create', compact('proformaInvoice', 'subtotal', 'ppn', 'grandTotalIncludePPN'));
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
    $proformaInvoice = ProformaInvoice::with('purchaseOrder')->findOrFail($proformaInvoiceId);
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