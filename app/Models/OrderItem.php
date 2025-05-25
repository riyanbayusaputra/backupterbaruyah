<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'price',
        'quantity',
        'custom_options_json',
    ];

    protected $casts = [
        'custom_options_json' => 'array',
    
    ];
    public function getCustomOptionsTextAttribute()
{
    $options = json_decode($this->custom_options_json, true);
    if (is_array($options)) {
        return implode(', ', $options);
    }
    return '-';
}

    public function getFormattedOptionsAttribute()
    {
        if (!$this->custom_options_json) {
            return [];
        }

        return $this->custom_options_json;
    }
    public function getFormattedCustomOptionsAttribute()
    {
        $options = $this->custom_options;
        if (empty($options)) {
            return '';
        }
        
        return implode(', ', $options);
    }

    /**
     * Check if item has custom options
     */
    public function hasCustomOptions()
    {
        return !empty($this->custom_options_json);
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

}
