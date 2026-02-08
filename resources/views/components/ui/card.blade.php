@props(['title' => null, 'description' => null])

<div {{ $attributes->merge(['class' => 'rounded-lg border border-border bg-card text-card-foreground shadow-sm']) }}>
    @if($title || $description)
        <div class="flex flex-col space-y-1.5 p-4 sm:p-6"> {{-- p-4 di mobile, p-6 di desktop --}}
            @if($title)
                <h3 class="text-lg font-semibold leading-none tracking-tight">{{ $title }}</h3>
            @endif
            @if($description)
                <p class="text-sm text-muted-foreground">{{ $description }}</p>
            @endif
        </div>
    @endif
    
    <div class="p-4 sm:p-6 pt-0 sm:pt-0">
        {{ $slot }}
    </div>
</div>
