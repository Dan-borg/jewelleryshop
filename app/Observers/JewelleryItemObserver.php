<?php

namespace App\Observers;

use App\Models\JewelleryItem;

class JewelleryItemObserver
{
    /**
     * Handle the JewelleryItem "created" event.
     */
    public function created(JewelleryItem $jewelleryItem): void
    {
        //
    }

    /**
     * Handle the JewelleryItem "updated" event.
     */
    public function updated(JewelleryItem $jewelleryItem): void
    {
        //
    }

    /**
     * Handle the JewelleryItem "deleted" event.
     */
    public function deleted(JewelleryItem $jewelleryItem): void
    {
        //
    }

    /**
     * Handle the JewelleryItem "restored" event.
     */
    public function restored(JewelleryItem $jewelleryItem): void
    {
        //
    }

    /**
     * Handle the JewelleryItem "force deleted" event.
     */
    public function forceDeleted(JewelleryItem $jewelleryItem): void
    {
        //
    }
}
