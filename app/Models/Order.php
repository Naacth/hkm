<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'produk_id',
        'order_number',
        'quantity',
        'total_price',
        'payment_method',
        'delivery_method',
        'proof_of_payment_image_path',
        'status',
        'customer_name',
        'customer_phone',
        'customer_nim',
        'customer_kelas',
        'customer_email',
        'customer_address',
        'notes',
        'voucher_code',
        'voucher_discount_percent',
        'discount_amount',
        'final_price',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_price' => 'decimal:2',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that was ordered.
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    /**
     * Generate unique order number
     */
    public static function generateOrderNumber()
    {
        $prefix = 'ORD';
        $date = now()->format('Ymd');
        $lastOrder = self::whereDate('created_at', today())->latest()->first();
        
        if ($lastOrder) {
            $lastNumber = intval(substr($lastOrder->order_number, -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . $date . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass()
    {
        return match($this->status) {
            'pending' => 'bg-warning',
            'confirmed' => 'bg-info',
            'processing' => 'bg-primary',
            'shipped' => 'bg-success',
            'delivered' => 'bg-success',
            'cancelled' => 'bg-danger',
            default => 'bg-secondary',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabel()
    {
        return match($this->status) {
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Diterima',
            'cancelled' => 'Dibatalkan',
            default => 'Unknown',
        };
    }
}
