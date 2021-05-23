<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- CONTENT START-->


                    <div class="grid grid-cols-1">
                        <div class="grid grid-rows-2">
                            <form method="POST" action="{{ route('student.update', $student) }}">
                                @method('PUT')
                                @csrf
                                <div>
                                    <label for="name">{{ __('Name') }}</label>
                                    <input id="name" class="block mt-1 w-full" type="text" name="name" required
                                        value="{{ $student->name }}" autofocus />
                                    <br />
                                    <label for="email">{{ __('Email') }}</label>
                                    <input id="email" class="block mt-1 w-full" type="email" name="email" required
                                        value="{{ $student->email }}" autofocus />
                                    <br />
                                    @php
                                        $schools = \App\Models\School::all();
                                    @endphp
                                    <label for="school_id">{{ __('Attending') }}</label>
                                    <select class="block mt-1 w-full" name="school_id" id="school_id">
                                        @foreach ($schools as $school)
                                            @if ($school->id == $student->school_id)
                                                <option value='{{ $school->id }}' selected='selected'>
                                                    {{ $school->name }}
                                                </option>
                                            @else
                                                <option value='{{ $school->id }}'>{{ $school->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-button class="ml-3">
                                        {{ __('Update') }}
                                    </x-button>
                                </div>
                            </form>

                            <div class="mt-4">
                                <h3 class="font-semibold text-lg text-gray-800 leading-tight">
                                    {{ __('Registered Classes') }}
                                </h3>
                                <hr />

                                @if (count($student->classes) > 0)


                                    @foreach ($student->classes as $class)
                                        <div class="flex">
                                            <div class="flex-grow ml-8"> {{ $class->name }} </div>
                                            <div>
                                                <a
                                                    href="{{ route('student.dropclass', [$class->id, $student->id]) }}">{{ __('Drop') }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="flex justify-center">
                                        <div class="text-gray-500">
                                            {{ $student->name }} has no class registered yet. <br />
                                            Let's add some.

                                        </div>
                                    </div>
                                @endif

                                <hr />

                                <form method="POST" action="{{ route('student.registerclass', $student->id) }}">
                                    @csrf
                                    <div class="mt-2">
                                        @if (count($errors) > 0 && $errors->first('reg_class_id'))
                                            <div class="text-red-500">
                                                {{ __('Class registered or not exist') }}
                                            </div>
                                        @endif
                                        <label for="reg_class_id">{{ __('Register') }}</label>
                                        @php
                                            $registered = array_map(function ($item) {
                                                return $item['id'];
                                            }, $student->classes->toArray());
                                        @endphp
                                        <select class="block mt-1 w-full" name="reg_class_id" id="reg_class_id">
                                            @foreach ($student->school->classes()->get() as $class)
                                                @if (in_array($class->id, $registered))
                                                    <option value='0' disabled>{{ $class->name }}
                                                    </option>
                                                @else
                                                    <option value='{{ $class->id }}'>{{ $class->name }}
                                                    </option>
                                                @endif


                                            @endforeach
                                        </select>
                                        <div class="flex items-center justify-end mt-4">
                                            <x-button class="ml-3">
                                                {{ __('Register') }}
                                            </x-button>
                                        </div>
                                        {{-- <a
                                        href={{ route('student.registerclass', $student->id) }}>{{ __('Add New Class') }}</a> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!--CONTENT END -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
