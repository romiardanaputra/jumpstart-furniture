<div>
    <section class="container mx-auto my-[100px]">
        <h2 class="font-rufina text-[38px] text-center">From Our Blog</h2>
        <div class="grid grid-cols-3 gap-3 mt-[42px] px-[110px]">
            @foreach($blogs as $blog)
            <div class="blog w-[414px] h-[400px]">
                <div class="w-full h-[257px] overflow-hidden relative cursor-pointer">
                    <img class="mb-[20px] hover:scale-110 transition duration-300 ease-in-out"
                        src="{{ asset('storage/'. $blog->blog_image) }}" alt="{{ $blog->blog_title }}">
                </div>
                <div class="blog-content mt-[20px] w-full">
                    <p class="text-[14px] text-[#f4841a]">{{ $blog->created_at }}</p>
                    <p class="font-rufina font-semibold text-[18px] my-[8px]">{{ $blog->blog_title }}
                    </p>
                    <p class="text-[14px] truncate">{{ $blog->blog_long_description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>