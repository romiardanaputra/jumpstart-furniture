<?php

namespace App\Http\Livewire\Admin;

use App\Contracts\Services\WishlistServiceInterface;
use Livewire\Component;

class WishlistAnalytics extends Component
{
    public $limit = 5;

    public function render(WishlistServiceInterface $wishlistService)
    {
        $popularProducts = $wishlistService->getWishlistAnalytics($this->limit);

        return view('livewire.admin.wishlist-analytics', [
            'popularProducts' => $popularProducts
        ]);
    }
}
