<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'custom_options_json'
    ];

    protected $casts = [
        'custom_options_json' => 'array',
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function getFormattedOptionsAttribute()
    {
        if (!$this->custom_options_json) {
            return [];
        }

        return $this->custom_options_json;
    }
}
