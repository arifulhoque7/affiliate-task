<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $headerText }} -- ({{ $totalCommission }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 overflow-x-auto">
                        <div class="inline-block w-full overflow-hidden align-middle">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        @if (auth()->user()->type == 1)
                                            <th
                                                class="px-6 py-3 bg-gray-200 text-white-600 uppercase text-xs leading-4 font-semibold tracking-wider">
                                                {{ __('Referrel Name') }}</th>
                                        @endif
                                        <th
                                            class="px-6 py-3 bg-gray-200 text-white-600 uppercase text-xs leading-4 font-semibold tracking-wider">
                                            {{ __('Transaction By') }}</th>
                                        <th
                                            class="px-6 py-3 bg-gray-200 text-white-600 uppercase text-xs leading-4 font-semibold tracking-wider">
                                            {{ __('Transaction Amount') }}</th>
                                        <th
                                            class="px-6 py-3 bg-gray-200 text-white-600 uppercase text-xs leading-4 font-semibold tracking-wider">
                                            {{ __('Commission') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($commissions as $item)
                                        <tr class="text-white-700">
                                            @if (auth()->user()->type == 1)
                                                <td
                                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                                    {{ $item->user->name }}</td>
                                            @endif
                                            <td
                                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                                {{ $item->createdBy->name }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                                {{ $item->amount }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                                {{ $item->commission }}</td>
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
</x-app-layout>
