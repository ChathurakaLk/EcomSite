<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Update') }} product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto space-y-6 sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Update') }} product</h1>
                            <p class="mt-2 text-sm text-gray-700">Update existing {{ __('product') }}.</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('product.index') }}"
                                class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back</a>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="max-w-xl py-2 align-middle">
                                <form method="POST" action="{{ route('product.update', $product->id) }}" role="form"
                                    enctype="multipart/form-data">
                                    {{ method_field('PATCH') }}
                                    @csrf
                                    <div class="space-y-6">

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
                                            <x-input-label for="price" :value="__('price')" />
                                            <x-text-input id="price" name="price" type="text"
                                                class="block w-full mt-1" :value="old('price', $product?->price)" autocomplete="price"
                                                placeholder="price" />
                                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
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
