<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('School') }} <b>{{ $school->name }}</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- CONTENT START-->
                    @foreach ($school->classes as $class)
                        <div class="flex">
                            <div class="flex-grow"> {{ $class->name }} </div>
                            <div>
                                <a href="{{ route('class.edit', $class) }}">{{ __('Edit') }}</a> |
                                <a href="{{ route('class.delete', $class) }}">{{ __('Remove') }}</a>
                            </div>

                        </div>
                    @endforeach
                    <div class="flex items-center justify-end mt-4">
                        <a href={{ route('school.newclass', $school->id) }}>{{ __('Add New Class') }}</a>
                    </div>

                    <!--CONTENT END -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
