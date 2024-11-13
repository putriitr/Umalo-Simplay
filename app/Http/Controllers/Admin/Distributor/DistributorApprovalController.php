<?php
namespace App\Http\Controllers\Admin\Distributor;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
class DistributorApprovalController extends Controller
{
    public function show($id)
{
    // Find the distributor by ID
    $distributor = User::findOrFail($id);
    // Pass the distributor to the view
    return view('admin.distributors.show', compact('distributor'));
}
    public function index()
    {
        // Retrieve all distributors, including both verified and unverified
        $distributors = User::where('type', '2')->get();
        return view('admin.distributors.index', compact('distributors'));
    }
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->verified = true;
        $user->save();
        return redirect()->route('admin.distributors.index')->with('success', 'Distributor approved successfully.');
    }
}