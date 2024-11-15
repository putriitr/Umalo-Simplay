<?php
namespace App\Http\Controllers\Distribution\Portal;
use App\Http\Controllers\Controller;
use App\Models\ProformaInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class ProformaInvoiceDistributorController extends Controller
{
    public function index()
    {
        // Mengambil Proforma Invoices yang terkait dengan Purchase Orders milik Distributor yang login
        $proformaInvoices = ProformaInvoice::whereHas('purchaseOrder', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('purchaseOrder')->get();
        return view('Distributor.Portal.ProformaInvoice.index', compact('proformaInvoices'));
    }
    public function uploadPaymentProof(Request $request, $id)
{
    $request->validate([
        'payment_proof' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);
    $proformaInvoice = ProformaInvoice::findOrFail($id);
    // Unggah file
    if ($request->hasFile('payment_proof')) {
        $file = $request->file('payment_proof');
        $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $path = public_path('uploads/payment_proofs');
        
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
        $file->move($path, $fileName);
        $proformaInvoice->payment_proof_path = 'uploads/payment_proofs/' . $fileName;
        $proformaInvoice->save();
    }
    return redirect()->route('distributor.proforma-invoices.index')->with('success', 'Bukti pembayaran berhasil diunggah.');
}
}