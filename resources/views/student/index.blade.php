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
                    <div class="overflow-x-auto">
                        <table class="table w-full list">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>School</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>
                                            <div>{{ $student->id }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $student->name }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $student->email }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $student->school->name }}</div>
                                        </td>
                                        <td><a href="{{ route('student.edit', $student) }}">Edit</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>School</th>

                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!--CONTENT END -->
                    <div class="mt-2">
                        {{ $students->links() }}
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
