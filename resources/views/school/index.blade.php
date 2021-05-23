<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schools') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- CONTENT START-->
                    <div class="overflow-x-auto">
                        <table class="table w-full list">

                            <tbody>
                                @foreach ($schools as $school)
                                    <tr>
                                        <td>
                                            <div>{{ $school->id }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $school->name }}</div>
                                        </td>

                                        <td><a href="{{ route('school.edit', $school) }}">View Classes</a></td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    <!--CONTENT END -->
                    <div class="mt-2">
                        {{ $schools->links() }}
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
