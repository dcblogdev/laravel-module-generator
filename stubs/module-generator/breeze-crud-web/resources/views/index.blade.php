<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('{Module}') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <p><a href="{{ route('{module}.create') }}" class="bg-blue-600 text-white px-1.5 py-2.5 rounded-md my-10">Add {Model}</a></p>

                    <table class="mt-10 w-full">
                        <tr>
                            <td>Name</td>
                            <td>Action</td>
                        </tr>
                        @foreach(${module} as ${model})
                            <tr>
                                <td>{{ ${model}->name }}</td>
                                <td>
                                    <a href="{{ route('{module}.edit', ${model}->id) }}" class="text-blue-500">{{ __('Edit') }}</a>
                                    |
                                    <a href="{{ route('{module}.destroy', ${model}->id) }}" class="text-blue-500" onclick="event.preventDefault(); if(confirm('Are you sure?')){document.getElementById('delete-book-{{ ${model}->id }}').submit();}">{{ __('Delete') }}</a>

                                    <form action="{{ route('{module}.destroy', ${model}->id) }}" method="POST" id="delete-book-{{ ${model}->id }}" >
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
