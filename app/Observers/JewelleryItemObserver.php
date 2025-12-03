<?php

namespace App\Observers;

use App\Models\JewelleryItem;
use Illuminate\Support\Str;

class JewelleryItemObserver
{
    public function creating(JewelleryItem $item)
    {
        if (empty($item->slug)) {
            $base = Str::slug($item->name);
            $slug = $base;
            $i = 1;
            while (JewelleryItem::where('slug', $slug)->exists()) {
                $i++;
                $slug = $base . '-' . $i;
            }
            $item->slug = $slug;
        }
    }
}
