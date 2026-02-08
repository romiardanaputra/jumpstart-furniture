<?php

namespace App\Http\Livewire;

use App\Contracts\Services\WishlistServiceInterface;
use Livewire\Component;

class WishlistButton extends Component
{
    public $productId;
    public $isWishlisted = false;
    public $variant = 'default'; // 'default' or 'icon'

    protected $listeners = ['wishlistUpdated' => 'checkStatus'];

    public function mount(WishlistServiceInterface $wishlistService, $productId, $variant = 'default')
    {
        $this->productId = $productId;
        $this->variant = $variant;
        $this->checkStatus($wishlistService);
    }

    public function checkStatus(WishlistServiceInterface $wishlistService)
    {
        $this->isWishlisted = $wishlistService->isWishlisted(auth()->id(), $this->productId);
    }

    public function toggle(WishlistServiceInterface $wishlistService)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->isWishlisted = $wishlistService->toggleWishlist(auth()->id(), $this->productId);
        
        $this->emit('wishlistUpdated');
        
        $message = $this->isWishlisted ? 'Added to wishlist' : 'Removed from wishlist';
        $this->dispatchBrowserEvent('notify', ['message' => $message]);
    }

    public function render()
    {
        return view('livewire.wishlist-button');
    }
}
