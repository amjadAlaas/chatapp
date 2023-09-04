<template x-if="isMultiLevelMenuOpen">
    <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0"
        x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300"
        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
        class="p-2 mx-4 mt-2 space-y-2 overflow-hidden text-sm font-medium text-white bg-gray-700 bg-opacity-50 rounded-md shadow-inner"
        aria-label="submenu">
        @foreach ($allUsers as $user)
        <li class="px-2 py-1 transition-colors duration-150">
            <a class="w-full" href="{{route('messages.all', $user->id)}}">{{$user->name}}</a>
        </li>
        @endforeach
    </ul>
</template>
