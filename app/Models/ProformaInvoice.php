<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ProformaInvoice extends Model
{
    use HasFactory;
    // Tentukan tabel yang digunakan oleh model ini jika namanya tidak konvensional
    protected $table = 'proforma_invoices';
    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'purchase_order_id',
        'pi_number',
        'pi_date',
        'subtotal',
        'ppn',
        'grand_total_include_ppn',
        'dp',
        'file_path',
    ];
    /**
     * Relasi ke Purchase Order.
     * Proforma Invoice memiliki satu Purchase Order.
     */
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function getRemainingPaymentAttribute()
    {
        return $this->grand_total_include_ppn - $this->dp;
    }
}