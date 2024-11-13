<?php
namespace App\Http\Controllers\Distribution\Portal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
class QuotationController extends Controller
{
    /**
     * Show the details of a specific quotation.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $quotation = Quotation::with('produk')->findOrFail($id);
        
        return view('Distributor.Portal.show', compact('quotation'));
    }
    /**
     * Cancel a specific quotation.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel($id)
    {
        $quotation = Quotation::findOrFail($id);
        // Update the status to "canceled"
        $quotation->update(['status' => 'canceled']);
        return redirect()->route('distribution.request-quotation')->with('success', 'Permintaan quotation berhasil dibatalkan.');
    }
}