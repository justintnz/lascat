<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('School') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- CONTENT START-->
                    <form method="POST" action="{{ route('school.update', $school) }}">
                        @method('PUT')
                        @csrf
                        <div>
                            <label for="name" :value="__('Name')" />
                            <input id="name" name="name" value="{{ $school->name }}">
                        </div>

                        @foreach ($school->classes as $class)
                            <div> {{ $class->name }} </div>
                        @endforeach
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                    <!--CONTENT END -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
