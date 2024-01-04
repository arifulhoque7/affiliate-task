<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $headerText }}
        </h2>
    </x-slot>

    @if (!(auth()->user()->type == 3) || !(auth()->user()->type == 4))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-12">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-end">

                            <x-primary-button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'transactions-create')">
                                {{ __('Add Amount') }}
                            </x-primary-button>

                        </div>
                        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 overflow-x-auto">
                            <div class="inline-block w-full overflow-hidden align-middle">
                                <table class="w-full">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-6 py-3 bg-gray-200 text-white-600 uppercase text-xs leading-4 font-semibold tracking-wider">
                                                {{ __('Sl.') }}</th>
                                            <th
                                                class="px-6 py-3 bg-gray-200 text-white-600 uppercase text-xs leading-4 font-semibold tracking-wider">
                                                {{ __('Amount') }}</th>
                                            <th
                                                class="px-6 py-3 bg-gray-200 text-white-600 uppercase text-xs leading-4 font-semibold tracking-wider">
                                                {{ __('Details') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @foreach ($transactions as $index => $item)
                                            <tr class="text-white-700">
                                                <td
                                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                                    {{ $index + 1 }}</td> <!-- Serial Number -->
                                                <td
                                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                                    {{ $item->amount }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                                    {{ $item->details }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-modal name="transactions-create" :show="$errors->isNotEmpty()" focusable>
            <form method="POST" action="{{ route('transaction.store') }}" class="p-6">
                @csrf

                <div class="mt-6">
                    <x-input-label for="amount" value="{{ __('Amount') }}" class="block mt-1 w-full" />

                    <x-text-input id="amount" name="amount" type="text" class="mt-1 block w-full"
                        placeholder="{{ __('Amount') }}" />

                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-input-label for="details" value="{{ __('Details') }}" class="block mt-1 w-full" />

                    <x-text-input id="details" name="details" type="text" class="mt-1 block w-full"
                        placeholder="{{ __('Details') }}" />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button class="ms-3">
                        {{ __('Add') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    @endif



</x-app-layout>
