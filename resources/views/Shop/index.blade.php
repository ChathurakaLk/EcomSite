@extends('layouts.main-layout')
@section('title', 'Shope')
@section('extra-css')
    <style>
        .bg-primary {
            --tw-bg-opacity: 1;
            background-color: rgb(255 0 66 / var(--tw-bg-opacity));
        }

        .border-primary {
            --tw-border-opacity: 1;
            border-color: rgb(255 0 66 / var(--tw-border-opacity));
        }

        .work-sans {
            font-family: 'Work Sans', sans-serif;
        }

        #menu-toggle:checked+#menu {
            display: block;
        }

        .hover\:grow {
            transition: all 0.3s;
            transform: scale(1);
        }

        .hover\:grow:hover {
            transform: scale(1.02);
        }

        .carousel-open:checked+.carousel-item {
            position: static;
            opacity: 100;
        }

        .carousel-item {
            -webkit-transition: opacity 0.6s ease-out;
            transition: opacity 0.6s ease-out;
        }

        #carousel-1:checked~.control-1,
        #carousel-2:checked~.control-2,
        #carousel-3:checked~.control-3 {
            display: block;
        }

        .carousel-indicators {
            list-style: none;
            margin: 0;
            padding: 0;
            position: absolute;
            bottom: 2%;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 10;
        }

        #carousel-1:checked~.control-1~.carousel-indicators li:nth-child(1) .carousel-bullet,
        #carousel-2:checked~.control-2~.carousel-indicators li:nth-child(2) .carousel-bullet,
        #carousel-3:checked~.control-3~.carousel-indicators li:nth-child(3) .carousel-bullet {
            color: #000;
            /*Set to match the Tailwind colour you want the active one to be */
        }
    </style>
@endsection
@section('main')
    <section class="py-8 bg-white">
        <div class="container px-5 py-12 mx-auto">
            <a class="px-3 text-xl font-bold tracking-wide text-gray-800 no-underline uppercase hover:no-underline"
                href="#">
                Product Category
            </a>
            <div class="grid grid-cols-1 gap-8 mt-4 md:grid-cols-3">

                @foreach ($categories as $category)
                    <div class="relative overflow-hidden bg-white rounded-lg shadow-lg">
                        <img src="path/to/your/image1.jpg" class="object-cover w-full h-64">
                        <div class="absolute inset-0 opacity-75 bg-gradient-to-t from-blue-900 to-transparent"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-6">
                            <h2 class="text-2xl font-semibold text-white">{{ $category->name }}</h2>
                            <p class="mt-2 text-white">{{ $category->description }}</p>
                            <button
                                class="px-4 py-2 mt-4 text-white border rounded-full bg-primary border-primary hover:bg-transparent hover:text-primary">Get
                                Started</button>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>


    <section class="py-8 bg-white">

        <div class="container flex flex-wrap items-center pt-4 pb-12 mx-auto">
            <nav id="store" class="top-0 z-30 w-full px-6 py-1">
                <div class="container flex flex-wrap items-center justify-between w-full px-2 py-3 mx-auto mt-0">

                    <a class="text-xl font-bold tracking-wide text-gray-800 no-underline uppercase hover:no-underline "
                        href="#">
                        Store
                    </a>

                    <div class="flex items-center" id="store-nav-content">

                        <a class="inline-block pl-3 no-underline hover:text-black" href="#">
                            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
                            </svg>
                        </a>

                        <a class="inline-block pl-3 no-underline hover:text-black" href="#">
                            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z" />
                            </svg>
                        </a>

                    </div>
                </div>
            </nav>
            @foreach ($products as $product)
                <div class="flex flex-col w-full p-6 md:w-1/3 xl:w-1/4">
                    <a href="#">
                        <img class="object-cover w-full h-40 hover:grow hover:shadow-lg" src="{{ $product->imageUrl() }}">
                        <div class="flex items-center justify-between pt-3">
                            <p class="">{{ $product->name }}</p>
                            <a href="{{ route('addToCart', $product->id) }}">
                                <i class="w-6 h-6 text-gray-500 fill-current fa-solid fa-cart-plus hover:text-pink-600"></i>
                            </a>
                        </div>
                        <p class="pt-1 text-gray-900">Rs.{{ number_format($product->price, 2) }}</p>
                    </a>
                </div>
            @endforeach

    </section>
@endsection
