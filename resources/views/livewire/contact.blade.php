@section('title_web_page','Contact')
<div>
    <x-banner-parallax />
    <section class="text-gray-600 body-font relative pt-[50px]">
        <div class="container px-5 py-24 mx-auto flex sm:flex-nowrap flex-wrap">
            <div
                class="lg:w-2/3 md:w-1/2 bg-gray-300 overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5577.94783193845!2d115.1724312812821!3d-8.672070328029637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd247f0fd99a39b%3A0x9a24bac3e3a676e5!2sYayasan%20Suara%20Komunitas%20Satwa!5e0!3m2!1sid!2sid!4v1671712100430!5m2!1sid!2sid"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="absolute inset-0" frameborder="0" title="map"
                    marginheight="0" marginwidth="0" scrolling="no"></iframe>
                <div class="bg-white relative flex flex-wrap py-6 rounded shadow-md">
                    <div class="lg:w-1/2 px-6">
                        <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">ADDRESS</h2>
                        <p class="mt-1">Jl. Taman Sari Madu No.30, Kerobokan Kelod, Kec. Kuta Utara, Kabupaten
                            Badung, Bali 80361</p>
                    </div>
                    <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                        <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">EMAIL</h2>
                        <a class="text-indigo-500 leading-relaxed">jumpstart@gmail.com</a>
                        <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs mt-4">PHONE</h2>
                        <p class="leading-relaxed">123-456-7890</p>
                    </div>
                </div>
            </div>
            <form method="POST" action=""
                class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
                <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Contact Us</h2>
                <p class="leading-relaxed mb-5 text-gray-600">Sharing Together Means We Care Each Other</p>
                <div class="relative mb-4">
                    <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                    <input type="text" id="name" name="name"
                        class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
                <div class="relative mb-4">
                    <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
                <div class="relative mb-4">
                    <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
                    <textarea id="message" name="message"
                        class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                </div>
                <button type="button"
                    class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-[3rem] py-3 hover:scale-105 transition duration-300 ease-in-out uppercase">Send
                    Now</button>
            </form>
        </div>
    </section>
</div>