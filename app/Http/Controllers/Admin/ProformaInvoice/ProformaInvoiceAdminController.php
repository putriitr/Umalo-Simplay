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
    
        // Mendapatkan daftar produk dari quotation_products
        $products = $quotation->quotationProducts->map(function ($product) {
            return [
                'description' => $product->equipment_name,
                'qty' => $product->quantity,
                'unit' => $product->merk_type,
                'unit_price' => $product->unit_price,
            ];
        });
    
        return view('Admin.ProformaInvoice.create', compact('purchaseOrder', 'subtotal', 'ppn', 'grandTotalIncludePPN', 'products'));
    }
    
    // Menyimpan Proforma Invoice ke database dan generate PDF
    public function store(Request $request, $purchaseOrderId)
    {
        $request->validate([
            'pi_number' => 'required|unique:proforma_invoices',
            'pi_date' => 'required|date',
            'dp' => 'nullable|numeric',
            'vendor_name' => 'required|string',
            'vendor_address' => 'required|string',
            'vendor_phone' => 'required|string',
            'products' => 'required|array',
        ]);
        // Buat Proforma Invoice
        $proformaInvoice = ProformaInvoice::create([
            'purchase_order_id' => $purchaseOrderId,
            'pi_number' => $request->pi_number,
            'pi_date' => $request->pi_date,
            'subtotal' => $request->subtotal,
            'ppn' => $request->ppn,
            'grand_total_include_ppn' => $request->grand_total_include_ppn,
            'dp' => $request->dp,
        ]);
        // Generate PDF
        $pdf = PDF::loadView('Admin.ProformaInvoice.pdf', [
            'proformaInvoice' => $proformaInvoice,
            'purchaseOrder' => $proformaInvoice->purchaseOrder,
            'vendorName' => $request->vendor_name,
            'vendorAddress' => $request->vendor_address,
            'vendorPhone' => $request->vendor_phone,
            'products' => $request->products,
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