@section('title_web_page', 'Journal — JumpStart Furniture')

<div class="bg-brand-cream">
    <x-banner-parallax title_page="Our Journal" page_image="{{ asset('assets/parallax-img.png') }}" />
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20">
        <x-blog :blogs="$blogs" />
    </div>
</div>