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
        })
            ->with('purchaseOrder')
            ->get()
            ->map(function ($invoice) {
                // Hitung persen DP dan simpan dalam properti dinamis
                if ($invoice->grand_total_include_ppn > 0) {
                    $invoice->dp_percent = ($invoice->dp / $invoice->grand_total_include_ppn) * 100;
                } else {
                    $invoice->dp_percent = 0;
                }
                return $invoice;
            });

        return view('Distributor.Portal.ProformaInvoice.index', compact('proformaInvoices'));
    }
    public function uploadPaymentProof(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10048',
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

            $filePath = 'uploads/payment_proofs/' . $fileName;
            $file->move($path, $fileName);
            // Cek apakah ini adalah unggahan pertama (untuk DP) atau unggahan kedua (untuk sisa pembayaran)
            if (!$proformaInvoice->payment_proof_path) {
                // Pertama kali upload, simpan sebagai bukti DP
                $proformaInvoice->payment_proof_path = $filePath;
                $proformaInvoice->status = 'partially_paid';  // Status berubah menjadi partially_paid
            } else {
                // Kedua kali upload, simpan sebagai bukti sisa pembayaran
                $proformaInvoice->second_payment_proof_path = $filePath;
                $proformaInvoice->status = 'paid';  // Status berubah menjadi paid
            }
            
            $proformaInvoice->save();
        }
        return redirect()->route('distributor.proforma-invoices.index')->with('success', 'Bukti pembayaran berhasil diunggah.');
    }
}