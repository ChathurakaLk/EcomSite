<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create') }} Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto space-y-6 sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Create') }} Product</h1>
                            <p class="mt-2 text-sm text-gray-700">Add a new {{ __('Product') }}.</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('product.index') }}"
                                class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back</a>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="max-w-xl py-2 align-middle">
                                <form method="POST" action="{{ route('product.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="space-y-6">

                                        <div>
                                            <x-input-label for="category_id" :value="__('Category')" />
                                            <select id="category_id" name="category_id" type="text"
                                                class="block w-full mt-1 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $key => $category)
                                                    <option value="{{ $key }}">{{ $category }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                                        </div>
                                        <div>
                                            <x-input-label for="name" :value="__('Name')" />
                                            <x-text-input id="name" name="name" type="text"
                                                class="block w-full mt-1" :value="old('name', $product?->name)" autocomplete="name"
                                                placeholder="Name" />
                                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                        </div>
                                        <div>
                                            <x-input-label for="description" :value="__('Description')" />
                                            <x-text-input id="description" name="description" type="text"
                                                class="block w-full mt-1" :value="old('description', $product?->description)" autocomplete="description"
                                                placeholder="Description" />
                                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                        </div>
                                        <div>
                                            <x-input-label for="price" :value="__('Price')" />
                                            <x-text-input id="price" name="price" type="text"
                                                class="block w-full mt-1" :value="old('price', $product?->price)" autocomplete="price"
                                                placeholder="price" />
                                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                                        </div>
                                        <div>
                                            <x-input-label for="qty" :value="__('Qty')" />
                                            <x-text-input id="qty" name="qty" type="text"
                                                class="block w-full mt-1" :value="old('qty', $product?->qty)" autocomplete="qty"
                                                placeholder="qty" />
                                            <x-input-error class="mt-2" :messages="$errors->get('qty')" />
                                        </div>
                                        <div>
                                            <x-input-label for="image" :value="__('Image')" />
                                            <x-text-input id="image" name="image" type="file"
                                                class="block w-full mt-1" />
                                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                        </div>

                                        <div class="flex items-center gap-4">
                                            <x-primary-button>Submit</x-primary-button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
