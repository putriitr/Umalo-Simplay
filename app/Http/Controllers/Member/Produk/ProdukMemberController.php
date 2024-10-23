<?php

namespace App\Http\Controllers\Member\Produk;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukMemberController extends Controller
{
    // Controller
    public function index($categoryId = null)
    {
        // Get all categories
        $kategori = Kategori::all();


        // Check if a category is selected, if so, filter products by that category
        if ($categoryId) {
            $produks = Produk::where('kategori_id', $categoryId)->get();
            $selectedCategory = Kategori::find($categoryId); // To highlight the selected category
        } else {
            $produks = Produk::all();
            $selectedCategory = null;
        }

        return view('member.product.product', compact('produks', 'kategori', 'selectedCategory'));
    }

    public function search(Request $request)
    {
        // $query = $request->input('search');
        $kategori = Kategori::all();
        $keyword = $request->keyword;

        // Validasi atau logika pencarian produk
        $produks = Produk::where('nama', 'LIKE', '%' . $keyword . '%')->get();

        // Log::channel('stderr')->info("test");
        // error_log(json_encode($produks));
        // exit();
        $selectedCategory = null;

        return view('member.product.product', compact('produks', 'kategori', 'selectedCategory'));

        // return response()->json($produks);
    }

    public function filterByCategory($id)
    {
        // Get all categories for the sidebar
        $kategori = Kategori::all();

        // Filter products by the selected category
        $produks = Produk::where('kategori_id', $id)->get();  // Assuming kategori_id is the foreign key in the Produk model

        // Pass the selected category ID for highlighting the active category
        $selectedCategory = Kategori::find($id);

        return view('member.product.product', compact('produks', 'kategori', 'selectedCategory'));
    }


    public function show($id)
    {
        // Mengambil detail produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        $produkSerupa = Produk::where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $id) // Exclude the current product
            ->take(4) // Limit to 4 similar products
            ->get();

        return view('member.product.detail', compact('produk', 'produkSerupa'));
    }
}
