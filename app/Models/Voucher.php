<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_percent',
        'applicable_type',
        'applicable_id',
        'is_active',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}


