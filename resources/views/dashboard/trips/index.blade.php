<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trips') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-primary-link :href=" route('dashboard.trips.create')">
                        {{ __('Create Trip') }}
                    </x-primary-link>
                </div>


                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">Title</th>
                                        <th class="px-4 py-2">Sets</th>
                                        <th class=" px-4 py-2">Stations</th>
                                        <th class="px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trips as $trip)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $trip->title }}</td>
                                        <td class="border px-4 py-2">{{ $trip->sets }}</td>
                                        <td class="border px-4 py-2">
                                            @foreach ($trip->stations as $station)

                                            <span class="
                                            inline-flex items-center px-3 py-3 rounded-full text-xs font-medium
                                            bg-gray-100 text-gray-800

                                            ">
                                                {{ $station->fromCity->name }} - {{ $station->toCity->name }}

                                            </span>
                                            @endforeach
                                        </td>
                                        <td class="border px-4 py-2">
                                            {{-- <x-primary-link :href=" route('dashboard.trips.edit', $trip)">
                                                {{ __('Edit') }}
                                            </x-primary-link> --}}

                                            <form method="POST" class="inline-flex" action="{{ route('dashboard.trips.destroy', $trip) }}">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button class="ms-3">
                                                    {{ __('Delete') }}
                                                </x-danger-button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $trips->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</x-app-layout>
