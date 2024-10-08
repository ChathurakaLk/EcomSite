<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('dash.Dashboard') }}

        </h2>
    </x-slot>
    <div class="max-w-96 flex justify-center">
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
    </div>
    <div class="flex pt-12">

        @if (Auth::User()->hasRole('admin|seller|buyer'))
            <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-3">
                <div class="overflow-hidden bg-red-300 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('admin | seller | buyer') }}
                    </div>
                </div>
            </div>
        @endif
        @if (Auth::User()->hasRole('admin|seller'))
            <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-green-300 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('admin | seller') }}
                    </div>
                </div>
            </div>
        @endif
        @if (Auth::User()->hasRole('admin'))
            <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-blue-300 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('admin') }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- easy way --}}

    <div class="flex py-4">
        @role('admin|seller|buyer')
            <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-3">
                <div class="overflow-hidden bg-red-700 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('admin | seller | buyer') }}
                    </div>
                </div>
            </div>
        @endrole
        @role('admin|seller')
            <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-green-700 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('admin | seller') }}
                    </div>
                </div>
            </div>
        @endrole
        @role('admin')
            <div class="w-full mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-blue-700 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('admin') }}
                    </div>
                </div>
            </div>
        @endrole
    </div>
</x-app-layout>
