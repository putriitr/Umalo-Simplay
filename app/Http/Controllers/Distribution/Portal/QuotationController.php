<?php
namespace App\Http\Controllers\Distribution\Portal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\Produk;
use App\Models\QuotationProduct;

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

        // Periksa apakah file PDF sudah tersedia dan status masih "Pending"
        if ($quotation->pdf_path && $quotation->status === 'pending') {
            // Perbarui status menjadi "Quotation"
            $quotation->update(['status' => 'quotation']);
        }

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

    public function cart()
    {
        // Ambil data produk yang sudah ditambahkan ke keranjang (dari sesi)
        $cartItems = session()->get('quotation_cart', []);
        return view('Distributor.Portal.cart', compact('cartItems'));
    }
    public function addToCart(Request $request)
    {
        $productId = $request->input('produk_id');
        $quantity = $request->input('quantity');
        // Ambil data produk
        $produk = Produk::find($productId);
        if ($produk) {
            // Tambahkan produk ke sesi
            $cartItems = session()->get('quotation_cart', []);
            $cartItems[] = [
                'produk_id' => $produk->id,
                'nama' => $produk->nama,
                'quantity' => $quantity,
            ];
            session()->put('quotation_cart', $cartItems);
            return redirect()->route('quotations.cart')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
        }
        return redirect()->back()->with('error', 'Produk tidak ditemukan.');
    }
    public function submitCart()
    {
        $cartItems = session()->get('quotation_cart', []);
        if (empty($cartItems)) {
            return redirect()->route('quotations.cart')->with('error', 'Keranjang kosong.');
        }
        $quotationNumber = 'Q-' . now()->format('YmdHis') . '-' . auth()->id();

        // Hitung nomor pengajuan berdasarkan bulan dan tahun ini
        $currentMonth = now()->format('m');
        $currentYear = now()->format('Y');

        $lastQuotation = Quotation::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->orderBy('id', 'desc')
            ->first();
        
            // Tentukan nomor pengajuan berikutnya
        $nextNumber = $lastQuotation ? intval(explode('/', $lastQuotation->nomor_pengajuan)[0]) + 1 : 1;
        $nomorPengajuan = str_pad($nextNumber, 2, '0', STR_PAD_LEFT) . '/' . $currentMonth . '/' . $currentYear;
        
        // Buat quotation baru dengan nomor pengajuan
        $quotation = Quotation::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'nomor_pengajuan' => $nomorPengajuan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Simpan setiap produk di quotation_product
        foreach ($cartItems as $item) {
            
            
            $produk = Produk::find($item['produk_id']);
            if (!$produk) {
                continue; 
            }
            
            
            $unitPrice = $item['unit_price'] ?? 0;
            $totalPrice = $item['quantity'] * $unitPrice;
            QuotationProduct::create([
                'quotation_id' => $quotation->id,
                'produk_id' => $item['produk_id'],
                'quantity' => $item['quantity'],
                'created_at' => now(),
                'updated_at' => now(),
                'equipment_name' => $produk->nama, 
                'merk_type' => $produk->merk,      
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
            ]);
        }
        // Kosongkan keranjang setelah submit
        session()->forget('quotation_cart');
        return redirect()->route('distribution.request-quotation')->with('success', 'Permintaan quotation berhasil diajukan dengan nomor pengajuan: ' . $nomorPengajuan);
    }
    public function updateCart(Request $request)
    {
        $productId = $request->input('produk_id');
        $quantity = $request->input('quantity');
        $cartItems = session()->get('quotation_cart', []);
        foreach ($cartItems as &$item) {
            if ($item['produk_id'] == $productId) {
                $item['quantity'] = $quantity;
                break;
            }
        }
        session()->put('quotation_cart', $cartItems);
        return redirect()->route('quotations.cart')->with('success', 'Quantity berhasil diperbarui.');
    }
    public function removeFromCart(Request $request)
    {
        $productId = $request->input('produk_id');
        $cartItems = session()->get('quotation_cart', []);
        $cartItems = array_filter($cartItems, function ($item) use ($productId) {
            return $item['produk_id'] != $productId;
        });
        session()->put('quotation_cart', $cartItems);
        return redirect()->route('quotations.cart')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}