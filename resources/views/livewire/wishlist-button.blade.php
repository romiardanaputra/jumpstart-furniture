<div>
    @if($variant === 'icon')
        <button 
            wire:click="toggle" 
            class="p-2 rounded-full transition-all duration-300 {{ $isWishlisted ? 'bg-red-50 text-red-500 hover:bg-red-100' : 'bg-muted/50 text-muted-foreground hover:bg-muted hover:text-foreground' }}"
            title="{{ $isWishlisted ? 'Remove from wishlist' : 'Add to wishlist' }}"
        >
            <svg class="w-5 h-5 {{ $isWishlisted ? 'fill-current' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </button>
    @else
        <x-ui.button 
            wire:click="toggle" 
            variant="{{ $isWishlisted ? 'primary' : 'outline' }}" 
            class="flex-1 sm:flex-none flex items-center justify-center space-x-2 h-12 px-8 rounded-full"
        >
            <svg class="w-5 h-5 {{ $isWishlisted ? 'fill-current' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <span>{{ $isWishlisted ? 'Wishlisted' : 'Add to Wishlist' }}</span>
        </x-ui.button>
    @endif
</div>
