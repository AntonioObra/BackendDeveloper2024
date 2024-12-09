<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Todos') }}
            </h2>

            <div class="flex items-center gap-10">
                <x-nav-link :href="route('todos/create')" :active="request()->routeIs('todos/create')">
                    {{ __('Add new todo') }}
                </x-nav-link>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-gray-900">
                    {{ __("Create new todo") }}
                </div>

                <form method="POST" action="/todos/create" class="mt-10 flex flex-col gap-5">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description"  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                     <div>
                         <x-primary-button type="submit">Create new todo</x-primary-button>
                     </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
