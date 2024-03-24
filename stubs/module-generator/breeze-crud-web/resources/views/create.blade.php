<x-base::layouts.app>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create {Model}') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('{module}.store') }}">
                        @csrf

                        <div>
                            <x-base::input-label for="name" :value="__('Name')" />
                            <x-base::text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" autofocus autocomplete="name" />
                            <x-base::input-error class="mt-2" :messages="$errors->get('name')" />
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
