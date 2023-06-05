<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        {{-- Font Awesome --}}
        <link href="{{ asset('css/fontawsome-free-all.min.css') }}" rel="stylesheet" type="text/css">

        {{-- Tailwind --}}
        <script src="https://cdn.tailwindcss.com"></script>


        <!-- jquery -->
        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

        {{-- Slick Carousel --}}
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    </head>
    <body>
        @if (Route::has('login'))
        <nav class="w-full flex justify-between bg-lime-700 px-10 py-4">
            <a href="{{ url('/') }}" class="flex gap-2 items-center ml-10">
                <i class="fas fa-laugh-wink text-white text-4xl -rotate-[15deg]"></i>
                <p class="font-bold text-xl text-white">GETCO</p>
            </a>
            <div class="flex items-center mr-10 gap-4">
                @auth
                <a href="{{ url('/home') }}" class="relative inline-flex items-center justify-center text-sm font-semibold text-gray-100 rounded-md bg-lime-800 px-4 py-2 border border-gray-100 hover:text-white hover:bg-lime-900 hover:border-white">Home</a>
                @else
                {{-- <a class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 font-semibold rounded text-sm px-5 py-3 text-center mr-2 mb-2" href="{{ route('login') }}">
                    Log in
                </a> --}}
                <a class="relative inline-flex items-center justify-center text-sm font-semibold text-gray-100 rounded-md bg-lime-800 px-4 py-2 border border-gray-100 hover:text-white hover:bg-lime-900 hover:border-white" href="{{ route('login') }}">
                    Log in
                </a>
                @if (Route::has('register'))
                <a class="relative inline-flex items-center justify-center text-sm font-semibold text-lime-800 rounded-md bg-gray-50 px-4 py-2 border border-lime-800 hover:text-white hover:bg-lime-800 hover:border-white" href="{{ route('register') }}">Register
                </a>
                {{-- <a class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-semibold text-gray-900 rounded group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200" href="{{ route('register') }}">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        Register
                    </span>
                </a> --}}
                @endif
                @endauth
            </div>
        </nav>
        @endif
        <header class="h-[600px]" style="background-image: url('{{ asset('images/background.jpg') }}');">
            <div class="flex flex-col justify-center items-center h-full text-white max-w-5xl mx-auto text-center">
                <div class="flex gap-4 items-center">
                    <li class="fas fa-laugh-wink -rotate-[15deg] text-9xl"></li>
                    <p class="font-bold text-7xl">GETCO</p>
                </div>
                <p class="font-semibold text-xl pt-8">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas labore eveniet dolores neque non? Molestias perferendis ea repellat non dicta?</p>
            </div>
        </header>

        <section class="max-w-7xl mx-auto py-10 relative">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-center font-bold text-4xl">Kenapa GETCO?</h2>
                <p class="text-center text-gray-800 py-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quaerat veniam accusantium vero reiciendis sint eaque magni, voluptatem laudantium saepe a!</p>
            </div>
            <div class="flex justify-center gap-4 pt-4 pb-2 why">
                <div class="w-96 h-76 rounded shadow-xl bg-lime-100 p-8 hover mx-4">
                    <div class="bg-white w-20 h-20 rounded rotate-45 shadow-md mx-3 action">
                        <p class="font-semibold -rotate-45 flex justify-center items-center h-full text-xl ">1</p>
                    </div>
                    <h3 class="pt-6 pb-1 text-lime-500 font-bold">Full Support</h3>
                    <p class="text-gray-800">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis possimus, quibusdam amet ad consequatur unde!</p>
                </div>
                <div class="w-96 h-76 rounded shadow-xl bg-lime-100 p-8 hover mx-4">
                    <div class="bg-white w-20 h-20 rounded rotate-45 shadow-md mx-3 action">
                        <p class="font-semibold -rotate-45 flex justify-center items-center h-full text-xl ">2</p>
                    </div>
                    <h3 class="pt-6 pb-1 text-lime-500 font-bold">Plan Sederhana</h3>
                    <p class="text-gray-800">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis possimus, quibusdam amet ad consequatur unde!</p>
                </div>
                <div class="w-96 h-76 rounded shadow-xl bg-lime-100 p-8 hover mx-4">
                    <div class="bg-white w-20 h-20 rounded rotate-45 shadow-md mx-3 action">
                        <p class="font-semibold -rotate-45 flex justify-center items-center h-full text-xl ">3</p>
                    </div>
                    <h3 class="pt-6 pb-1 text-lime-500 font-bold">Produk Best Seller</h3>
                    <p class="text-gray-800">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis possimus, quibusdam amet ad consequatur unde!</p>
                </div>
                <div class="w-96 h-76 rounded shadow-xl bg-lime-100 p-8 hover mx-4">
                    <div class="bg-white w-20 h-20 rounded rotate-45 shadow-md mx-3 action">
                        <p class="font-semibold -rotate-45 flex justify-center items-center h-full text-xl ">4</p>
                    </div>
                    <h3 class="pt-6 pb-1 text-lime-500 font-bold">Terpercaya</h3>
                    <p class="text-gray-800">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis possimus, quibusdam amet ad consequatur unde!</p>
                </div>
            </div>
        </section>

        <section>
            <div class="max-w-5xl mx-auto bg-lime-100 p-10 rounded shadow-md my-10">
                <h2 class="font-bold text-center text-2xl px-20 pb-4">Sebelum melakukan registrasi, harap membaca dengan cermat syarat dan ketentuan berikut:</h2>
                <div class="text-lg">
                    {!! $syarat !!}
                </div>
                <p class="pt-4 text-sm">Dengan melakukan registrasi untuk akun premium, Anda mengkonfirmasi bahwa Anda telah membaca dan memahami syarat dan ketentuan di atas. Jika Anda tidak setuju dengan syarat dan ketentuan ini, harap jangan melanjutkan registrasi.</p>
            </div>
        </section>

        <footer class="flex justify-center gap-2 py-6 bg-lime-700 text-white">
            <p class="">Copyright</p>
            <a href="{{ url('/') }}" class="flex items-center gap-1 font-bold">
                <li class="fas fa-laugh-wink -rotate-[15deg]"></li>
                <p>GETCO</p>
            </a>
        </footer>

        {{-- Slick Carousel --}}
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script>
            $('.why').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                dots: true,
            });

            const hover = document.querySelectorAll('.hover')
            const action = document.querySelectorAll('.action')
            for(let i=0;i<hover.length;i++){
                hover[i].addEventListener('mouseover', function(){
                action[i].classList.add('bg-lime-400')
                })
                hover[i].addEventListener('mouseout', function(){
                action[i].classList.remove('bg-lime-400')
                })
            }
        </script>
    </body>
</html>
