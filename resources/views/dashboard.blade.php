<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Welcome Back,') }} {{ auth()->user()->name }}
                    @if(isset($promoCode[0]))
                    <span>| Your Promo Code: </span> <span class="text-red-800 font-extrabold">  {{ @$promoCode[0] }} </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
