<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
    type="button"
    class="z-10 inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-300 shadow-lg">
        <img src="/pnm.webp" alt="" class="w-32 mx-auto">
        <div class="text-xl text-center">SMP Negeri 1 Karas</div>
        <div class="text-xl text-center">Magetan, Jawa Timur</div>
        <hr class="h-1 mx-auto my-4 bg-black border-0 rounded">
        <ul class="space-y-2 font-medium">
            @foreach ($sidebar_data as $s)
                <li>
                    @if (isset($s->child))
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <img src="{{ $s->icon }}" alt="" class="w-8">
                            <span
                                class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap
                                {{ str_contains(URL::current(), $s->current) ? 'text-red-600' : '' }}">
                                {{ $s->title }}
                            </span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example" class="hidden py-2 space-y-2">
                            @foreach ($s->child as $item)
                                <li>
                                    <a href="{{ $item->route }}"
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                                        {{ str_contains(URL::current(), $item->current) ? 'text-red-600' : '' }}">
                                        {{ $item->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <a href="{{ $s->route }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg {{ str_contains(URL::current(), $s->current) ? 'text-red-600' : '' }} hover:bg-gray-100 group">
                            <img src="{{ $s->icon }}" alt="" class="w-8">
                            <span class="ms-3">{{ $s->title }}</span>
                        </a>
                    @endif
                </li>
            @endforeach
            <hr>
            <a href="{{ route('logout') }}"
                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group
                 hover:bg-red-700 dark:text-white dark:hover:bg-gray-700 bg-red-400">
                <img src="/static/check-out.png" alt="" class="w-8">
                <span class="flex-1 ms-3 text-left text-white">
                    Logout
                </span>
            </a>
        </ul>
    </div>
</aside>
