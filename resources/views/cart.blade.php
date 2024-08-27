@extends('layouts.main-layout')
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
    </style>
@endsection
@section('title', 'Shopping cart')
@section('main')

    <!-- Cart -->
    <section id="cart-page" class="py-16 bg-white">
        <div class="container px-4 mx-auto">
            <h1 class="mb-4 text-2xl font-semibold">Shopping Cart</h1>
            <div class="flex flex-col gap-4 md:flex-row">
                <div class="md:w-3/4">
                    <div class="p-6 mb-4 bg-white rounded-lg shadow-md">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th class="font-semibold text-center md:text-left">Product</th>
                                        <th class="font-semibold text-center">Price</th>
                                        <th class="font-semibold text-center">Quantity</th>
                                        <th class="font-semibold text-center md:text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-items">
                                    @php
                                        $total = 0;
                                    @endphp
                                    @forelse ($cart as $cartitem)
                                        @php
                                            $total += $cartitem['product']->price * $cartitem['qty'];
                                        @endphp
                                        <tr class="pb-4 border-b border-gray-line">
                                            <td class="px-1 py-4">
                                                <div
                                                    class="flex flex-col items-center text-center sm:flex-row sm:text-left">
                                                    <img class="w-16 h-16 mb-4 md:h-24 md:w-24 sm:mr-8 sm:mb-0"
                                                        src="{{ $cartitem['product']->imageUrl() }}">
                                                    <p class="text-sm md:text-base md:font-semibold">
                                                        {{ $cartitem['product']->name }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-1 py-4 text-center">Rs :
                                                {{ number_format($cartitem['product']->price, 2) }}</td>
                                            <td class="px-1 py-4 text-center">
                                                <div class="flex items-center justify-center">
                                                    <button
                                                        class="flex items-center justify-center w-10 h-10 text-white border rounded-full cart-decrement border-primary bg-primary hover:bg-transparent hover:text-black">-</button>
                                                    <p class="w-8 text-center quantity">{{ $cartitem['qty'] }}</p>
                                                    <button
                                                        class="flex items-center justify-center w-10 h-10 text-white border rounded-full cart-increment border-primary bg-primary hover:bg-transparent hover:text-black">+</button>
                                                </div>
                                            </td>
                                            <td class="px-1 py-4 text-right">Rs :
                                                {{ number_format($cartitem['product']->price * $cartitem['qty'], 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">Your Cart Is Empty !</tr>
                                    @endforelse

                                </tbody>
                            </table>
                            <div class="flex flex-col items-center justify-between px-1 mt-10 lg:flex-row">
                                <div class="flex mt-4 space-x-2 lg:mt-0">

                                    <a href="#"
                                        class="px-4 py-2 text-white border rounded-full bg-primary border-primary hover:bg-transparent hover:text-black">Empty
                                        Cart</a>
                                    <button
                                        class="px-4 py-2 text-white border rounded-full bg-primary border-primary hover:bg-transparent hover:text-black">Update
                                        Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/4">
                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <h2 class="mb-4 text-lg font-semibold">Summary</h2>
                        <div class="flex justify-between mb-4">
                            <p>Subtotal</p>
                            <p>{{ number_format($total, 2) }}</p>
                        </div>
                        <div class="flex justify-between pb-4 mb-4 border-b border-gray-line">
                            <p>Shipping</p>
                            <p>Rs : 0.00</p>
                        </div>
                        <div class="flex justify-between mb-2">
                            <p class="font-semibold">Total</p>
                            <p class="font-semibold">Rs : {{ number_format($total, 2) }}</p>
                        </div>
                        <a href="/checkout"
                            class="block w-full px-4 py-2 mt-4 text-center text-white border rounded-full bg-primary border-primary hover:bg-transparent hover:text-black">Proceed
                            to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
