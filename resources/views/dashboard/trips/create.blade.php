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
                    <x-primary-link :href=" route('dashboard.trips.index')">
                        {{ __('All Trips') }}
                    </x-primary-link>
                </div>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <form method="POST" action="{{ route('dashboard.trips.store') }}">
                                @csrf

                                <!-- Email Address -->
                                <div>
                                    <x-input-label for="title" :value="__('Title')" />

                                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>


                                <div>
                                    <x-input-label for="seats_limit" :value="__('Seats limit')" />

                                    <x-text-input id="seats_limit" class="block mt-1 w-full" type="number" name="seats_limit" :value="old('seats_limit',12)"
                                        required />
                                    <x-input-error :messages="$errors->get('seats_limit')" class="mt-2" />

                                </div>

                                {{-- time --}}

                                <div>
                                    <x-input-label for="time" :value="__('Time')" />

                                    <x-text-input id="time" class="block mt-1 w-full" type="datetime-local" name="time" :value="old('time')" required />
                                    <x-input-error :messages="$errors->get('time')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="sets" :value="__('Add Trip Line')" />

                                    <select id="citySelect" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm  mt-1 ">

                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach

                                    </select>



                                    <x-secondary-button class="ms-3" onclick="addCity()">
                                        {{ __('Add City to trip Line') }}
                                    </x-secondary-button>

                                    <div id="addedCities">
                                        @if(old('cities'))
                                        @foreach(old('cities') as $key => $cityId)
                                        @php
                                        $city=$cities->where('id',$cityId)->first();
                                        @endphp

                                        <div class="flex items-center justify-between bg-gray-100 p-2 rounded-md my-2 mt-4">
                                            <p class="text-gray-800 text-sm font-medium">{{ $city->name }}</p>
                                            <input type="hidden" name="cities[]" value="{{ $city->id }}">
                                            <button type="button"
                                                class="text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Delete</button>
                                        </div>
                                        @endforeach
                                        @endif




                                    </div>
                                </div>

                                <div class="flex items-center justify-end mt-4">

                                    <x-primary-button class="ms-3">
                                        {{ __('Save') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>



                    </div>


                </div>
            </div>
        </div>

        <script>
            function addCity() {
    var select = document.getElementById("citySelect");
    var selectedCity = select.value;
    var selectedCityText = select.options[select.selectedIndex].text;

    // Create a new div for the paragraph, hidden input and delete button
    var div = document.createElement("div");
    div.className = 'flex items-center justify-between bg-gray-100 p-2 rounded-md my-2 mt-4';

    // Create a paragraph element with the selected city text and Tailwind styling
    var paragraph = document.createElement("p");
    paragraph.textContent = selectedCityText;
    paragraph.className = 'text-gray-800 text-sm font-medium';
    div.appendChild(paragraph);

    // Create a hidden input field with the selected city value
    var hiddenInput = document.createElement("input");
    hiddenInput.type = "hidden";
    hiddenInput.name = "cities[]";
    hiddenInput.value = selectedCity;
    div.appendChild(hiddenInput);

    // Create a delete button for the entry with Tailwind styling
    var deleteButton = document.createElement("button");
    deleteButton.innerHTML = "Delete";
    deleteButton.className = 'text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center';
    deleteButton.onclick = function() {
        div.remove();
    };
    div.appendChild(deleteButton);

    // Add the div to the container
    document.getElementById("addedCities").appendChild(div);
}




        </script>
</x-app-layout>
