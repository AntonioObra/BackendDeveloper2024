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
                    {{ __("Edit todo") }}
                </div>

                <form method="POST" action="{{ route('todos.edit', $todo->id) }}" class="mt-10 flex flex-col gap-5">
                    @csrf
                    @method('patch')

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $todo->title)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description"  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>{{old('description', $todo->description)}}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                     <div class="flex gap-5">

                         <x-primary-button type="submit">Edit todo</x-primary-button>
                         <x-primary-button type="submit" form="set_todo_as_done">Mark todo as done</x-primary-button>
                         <x-primary-button type="submit" form="delete" class="ml-auto bg-red-500 hover:bg-red-600">Delete todo</x-primary-button>
                     </div>
                </form>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('todos.set_todo_as_done', $todo->id) }}" class="inline" id="set_todo_as_done">
        @csrf
        @method('patch')
    </form>

    <form method="POST" action="{{ route('todos.delete', $todo->id) }}" class="inline" id="delete">
        @csrf
        @method('delete')
    </form>
</x-app-layout>
