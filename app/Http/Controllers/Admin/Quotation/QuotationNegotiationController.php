<?php
namespace App\Http\Controllers\Admin\Quotation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\QuotationNegotiation;
class QuotationNegotiationController extends Controller
{
   // Menampilkan daftar negosiasi yang masuk
   public function index()
   {
    $negotiations = QuotationNegotiation::with('quotation')->get();
    return view('Admin.Quotation.Negotiation.index', compact('negotiations'));
   }
   public function accept($id, Request $request)
   {
       $negotiation = QuotationNegotiation::findOrFail($id);
       $negotiation->update([
           'status' => 'accepted',
           'admin_notes' => $request->input('notes'), // Menyimpan admin_notes ke database
       ]);
   
       return redirect()->route('admin.quotations.negotiations.index')->with('success', 'Negotiation accepted with notes.');
   }
   
   public function reject($id, Request $request)
   {
       $negotiation = QuotationNegotiation::findOrFail($id);
       $negotiation->update([
           'status' => 'rejected',
           'admin_notes' => $request->input('notes'), // Menyimpan admin_notes ke database
       ]);
   
       return redirect()->route('admin.quotations.negotiations.index')->with('success', 'Negotiation rejected with notes.');
   }
   
}