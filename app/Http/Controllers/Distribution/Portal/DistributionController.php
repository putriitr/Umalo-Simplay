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
        // Ambil ID pengguna yang sedang login
        $userId = auth()->id();
    
        // Ambil semua quotations milik pengguna yang sedang login
        $quotations = Quotation::with('quotationProducts')
            ->where('user_id', $userId)
            ->get();
    
        // Periksa status setiap quotation dan perbarui jika perlu
        foreach ($quotations as $quotation) {
            if ($quotation->pdf_path && $quotation->status === 'pending') {
                // Perbarui status menjadi "Quotation" jika PDF tersedia dan status masih "Pending"
                $quotation->update(['status' => 'quotation']);
            }
        }
    
        // Kirim data quotations ke view
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