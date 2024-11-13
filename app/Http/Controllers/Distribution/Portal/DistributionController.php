<?php
namespace App\Http\Controllers\Distribution\Portal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Quotation;

class DistributionController extends Controller
{
    // Halaman utama portal distributor
    public function index()
    {
        return view('Distributor.portal.portal'); // Pastikan view ini ada di resources/views/Distributor/portal/portal.blade.php
    }
    // Menampilkan halaman untuk memilih produk dan meminta quotation
    public function requestQuotation()
    {
        // Get the authenticated user's ID
        $quotations = Quotation::with('produk')->where('user_id', auth()->id())->get();

        // Pass the quotations to the view
        return view('Distributor.portal.request-quotation', compact('quotations'));
    }
    // Menampilkan halaman untuk membuat dan mengirim Purchase Order (PO)
    public function createPO()
    {
        return view('Distributor.portal.create-po'); // Pastikan view ini ada
    }
    // Menampilkan halaman untuk melihat dan mengelola invoice
    public function invoices()
    {
        return view('Distributor.portal.invoices'); // Pastikan view ini ada
    }
}