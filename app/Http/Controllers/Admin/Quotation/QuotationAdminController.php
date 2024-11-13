<?php
namespace App\Http\Controllers\Admin\Quotation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
class QuotationAdminController extends Controller
{
    /**
     * Display a list of all quotations for the admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Load all quotations with related product and user data
        $quotations = Quotation::with('produk', 'user')->get();
        return view('Admin.Quotation.index', compact('quotations'));
    }
    /**
     * Update the status of a specific quotation.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        $quotation = Quotation::findOrFail($id);
        // Update the quotation status
        $quotation->update([
            'status' => $request->input('status')
        ]);
        return redirect()->route('admin.quotations.index')->with('success', 'Status quotation berhasil diperbarui.');
    }
    /**
     * Upload a file for a specific quotation.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadFile(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:2048'
        ]);
        $quotation = Quotation::findOrFail($id);
        if ($request->hasFile('file')) {
            // Store file and update the file path in the quotation record
            $filePath = $request->file('file')->store('quotations', 'public');
            $quotation->update(['file_path' => $filePath]);
        }
        return redirect()->route('admin.quotations.index')->with('success', 'File berhasil diunggah untuk quotation.');
    }
}