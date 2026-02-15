<?php

namespace App\Http\Livewire;

use App\Contracts\Services\WishlistServiceInterface;
use Livewire\Component;

class WishlistPage extends Component
{
    protected $listeners = ['wishlistUpdated' => '$refresh'];

    public function removeFromWishlist(WishlistServiceInterface $wishlistService, $productId)
    {
        $wishlistService->toggleWishlist(auth()->id(), $productId);
        $this->emit('wishlistUpdated');
        $this->dispatchBrowserEvent('notify', ['message' => 'Removed from wishlist']);
    }

    public function render(WishlistServiceInterface $wishlistService)
    {
        $wishlistItems = $wishlistService->getUserWishlist(auth()->id());

        return view('livewire.wishlist-page', [
            'wishlistItems' => $wishlistItems
        ])->layout('layouts.app-user');
    }
}
