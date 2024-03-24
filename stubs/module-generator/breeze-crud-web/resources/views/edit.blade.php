<x-base::layouts.app>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit {Model}') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('{module}.update', ${model}) }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <x-base::input-label for="name" value="{{ __('Name') }}" />
                            <x-base::text-input id="name" name="name" class="w-full" value="{{ old('name', ${model}->name) }}" />
                            @if ($errors->has('name'))
                                <div class="text-red-500">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <x-base::primary-button type="submit" class="mt-3">
                            {{ __('Submit') }}
                        </x-base::primary-button>

                    </form>

                </div>
            </div>
        </div>
    </div>

</x-base::layouts.app>
