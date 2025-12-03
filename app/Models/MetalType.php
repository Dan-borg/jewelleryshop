<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetalType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'purity', 'color'];

    public function jewelleryItems()
    {
        return $this->hasMany(JewelleryItem::class);
    }
}
