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
                    {{ __("Your todos") }}
                </div>

                <ul class="flex flex-col gap-5 mt-10">
                    @foreach($todos as $todo)
                        <li class="p-5 rounded-lg {{$todo->is_done ? 'bg-gray-500 text-white' : 'bg-gray-100'}}">
                            <a href="/todos/edit/{{$todo->id}}">
                                <p class="text-xl">{{$todo->title}}</p>
                                <p>{{$todo->description}}</p>
                            </a>
                        </li>
                    @endforeach

                    @if($todos->isEmpty())
                        <p class="text-gray-500">You have no todos.</p>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
