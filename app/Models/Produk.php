<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'price', 'status', 'quality_guaranteed', 'periodic_support', 'support_24_7', 'features', 'qris_image_path', 'whatsapp_link',
        'seo_title', 'seo_description', 'seo_jsonld'
    ];

    protected $casts = [
        'quality_guaranteed' => 'boolean',
        'periodic_support' => 'boolean',
        'support_24_7' => 'boolean',
    ];

    /**
     * Get the orders for this product.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return $this->price ? 'Rp ' . number_format($this->price, 0, ',', '.') : 'Gratis';
    }

    /**
     * Get QRIS URL
     */
    public function getQrisUrlAttribute()
    {
        return $this->qris_image_path ? asset('uploads/' . $this->qris_image_path) : null;
    }
}
