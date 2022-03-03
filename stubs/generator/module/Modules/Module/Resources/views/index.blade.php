<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('{Module}') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <p><a href="{{ route('app.{module}.create') }}">Add {Model}</a> </p>

                    <table>
                        <tr>
                            <td>Name</td>
                            <td>Action</td>
                        </tr>
                        @foreach(${module} as ${model})
                            <tr>
                                <td>{{ ${model}->name }}</td>
                                <td>
                                    <a href="{{ route('app.{module}.edit', ${model}->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
