<?php
namespace App\Http\Controllers\Distribution\Portal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\QuotationNegotiation;
use Illuminate\Support\Facades\Auth;
class DistributorQuotationNegotiationController extends Controller
{
    // Menampilkan daftar negosiasi untuk distributor yang sedang login
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login (distributor)
        $userId = Auth::id();
        // Mengambil semua negosiasi terkait quotation milik distributor yang sedang login
        $negotiations = QuotationNegotiation::whereHas('quotation', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('quotation')->get();
        // Mengirim data negosiasi ke tampilan
        return view('Distributor.Portal.Negotiations.index', compact('negotiations'));
    }
    
    // Menampilkan form untuk negosiasi
    public function create($quotationId)
    {
        $quotation = Quotation::findOrFail($quotationId);
        return view('Distributor.Portal.negotiations.create', compact('quotation'));
    }
    // Menyimpan negosiasi baru
    public function store(Request $request, $quotationId)
    {
        $quotation = Quotation::findOrFail($quotationId);
        // Validasi input
        $request->validate([
            'negotiated_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);
        // Simpan negosiasi baru
        QuotationNegotiation::create([
            'quotation_id' => $quotation->id,
            'negotiated_price' => $request->input('negotiated_price'),
            'status' => 'in_progress',
            'notes' => $request->input('notes'),
        ]);
        return redirect()->route('distributor.quotations.negotiations.index', $quotation->id)->with('success', 'Negotiation submitted successfully.');
    }
}