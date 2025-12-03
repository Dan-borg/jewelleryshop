<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JewelleryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'metal_type_id',
        'name',
        'slug',
        'sku',
        'description',
        'price',
        'weight',
        'image_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function metalType()
    {
        return $this->belongsTo(MetalType::class);
    }
}
