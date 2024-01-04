<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $headerText }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end">
                        @if (!(auth()->user()->type == 3) || !(auth()->user()->type == 4))
                            <x-primary-button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'user-create')">
                                {{ __('Create User') }}
                            </x-primary-button>
                        @endif
                    </div>
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 overflow-x-auto">
                        <div class="inline-block w-full overflow-hidden align-middle">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-white-600 uppercase text-xs leading-4 font-semibold tracking-wider">
                                            {{ __('Name') }}</th>
                                        <th
                                            class="px-6 py-3 text-white-600 uppercase text-xs leading-4 font-semibold tracking-wider">
                                            {{ __('Email') }}</th>
                                        <th
                                            class="px-6 py-3 text-white-600 uppercase text-xs leading-4 font-semibold tracking-wider">
                                            {{ __('Date of Birth') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($users as $item)
                                        <tr class="text-white-700">
                                            <td
                                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                                {{ $item->name }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                                {{ $item->email }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                                {{ $item->dob }}</td>
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
    @if (!(auth()->user()->type == 3) || !(auth()->user()->type == 4))
        <x-modal name="user-create" :show="$errors->isNotEmpty()" focusable>
            <form method="POST" action="{{ route($user_create_route) }}" class="p-6">
                @csrf

                <div class="mt-6">
                    <x-input-label for="name" value="{{ __('Name') }}" class="block mt-1 w-full" />

                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        placeholder="{{ __('Name') }}" />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-input-label for="email" value="{{ __('Email') }}" class="block mt-1 w-full" />

                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                        placeholder="{{ __('Email') }}" />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="block mt-1 w-full" />

                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                        placeholder="{{ __('Password') }}" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-input-label for="dob" value="{{ __('Date of Birth') }}" class="block mt-1 w-full" />

                    <x-text-input id="dob" name="dob" type="date" class="mt-1 block w-full"
                        placeholder="{{ __('Date of Birth') }}" />

                    <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button class="ms-3">
                        {{ __('Create User') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    @endif



</x-app-layout>
