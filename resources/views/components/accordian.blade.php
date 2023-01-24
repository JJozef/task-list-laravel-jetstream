
<div x-data="{ open: false }" class="bg-gray-50 flex flex-col items-center justify-center relative overflow-hidden">
    <div @click="open = ! open"
        class="p-4 bg-blue-de rounded flex justify-between items-center w-full accordian-animation">
        <div class="flex items-center gap-2">
            {{ $icon }}
            <h4 class="font-medium text-base color-1fx3 ">{{ $title }}</h4>
        </div>
        <div class="icon-accordian">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </div>
    <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-0" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-10"
        x-transition:leave-end="opacity-0 translate-y-0"
        class="w-full bg-white boder-blue-de rounded-b-lg">
        <div class="p-1">
            {{ $content }}
        </div>
    </div>

</div>