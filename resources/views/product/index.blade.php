<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto space-y-6 sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('products') }}</h1>
                            <p class="mt-2 text-sm text-gray-700">A list of all the {{ __('products') }}.</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('product.create') }}"
                                class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add
                                new</a>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 border border-green-200 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 border border-red-200 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead>
                                        <tr>
                                            <th scope="col"
                                                class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-left text-gray-500 uppercase">
                                                Category</th>
                                            @role('admin')
                                                <th scope="col"
                                                    class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-left text-gray-500 uppercase">
                                                    Seller</th>
                                            @endrole
                                            <th scope="col"
                                                class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-left text-gray-500 uppercase">
                                                Name</th>
                                            <th scope="col"
                                                class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-left text-gray-500 uppercase">
                                                Description</th>
                                            <th scope="col"
                                                class="py-3 pl-4 pr-3 text-xs font-semibold tracking-wide text-left text-gray-500 uppercase">
                                                Price</th>

                                            <th scope="col"
                                                class="px-3 py-3 text-xs font-semibold tracking-wide text-left text-gray-500 uppercase">
                                                Qty
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3 text-xs font-semibold tracking-wide text-left text-gray-500 uppercase">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($products as $product)
                                            <tr class="even:bg-gray-50">
                                                <td
                                                    class="py-4 pl-4 pr-3 text-sm font-semibold text-gray-900 whitespace-nowrap">
                                                    {{ $product->category->name }}</td>
                                                @role('admin')
                                                    <td
                                                        class="py-4 pl-4 pr-3 text-sm font-semibold text-gray-900 whitespace-nowrap">
                                                        {{ $product->seller->name }}</td>
                                                @endrole

                                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ $product->name }}</td>
                                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ $product->description }}</td>
                                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ number_format($product->price, 2) }}</td>
                                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ $product->qty }}</td>

                                                <td
                                                    class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                    <form action="{{ route('product.destroy', $product->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('product.show', $product->id) }}"
                                                            class="mr-2 font-bold text-gray-600 hover:text-gray-900">{{ __('Show') }}</a>
                                                        <a href="{{ route('product.edit', $product->id) }}"
                                                            class="mr-2 font-bold text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('product.destroy', $product->id) }}"
                                                            class="font-bold text-red-600 hover:text-red-900"
                                                            onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">{{ __('Delete') }}</a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="px-4 mt-4">
                                    {!! $products->withQueryString()->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
