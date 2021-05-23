<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new class at') }} {{ $school->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- CONTENT START-->
                    <form method="POST" action="{{ route('class.add', $school->id) }}">
                        @method('POST')
                        @csrf
                        <div class="grid grid-cols-2 gap-6">
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <label for="name">{{ __('Name') }}</label>
                                    <input id="name" class="block mt-1 w-full" type="text" name="name" required value=""
                                        autofocus />
                                    <input id="school_id" type="hidden" name="school_id" required
                                        value="{{ $school->id }}" />

                                </div>

                            </div>
                        </div>
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
