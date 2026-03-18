<aside
    class="fixed inset-y-0 left-0 w-72 bg-white border-r border-gray-200 z-50
           transform -translate-x-full peer-checked:translate-x-0 lg:translate-x-0
           transition-transform duration-300 flex flex-col">

    <!-- Brand -->
    <div class="h-16 px-6 flex items-center border-b border-gray-200">
        <div class="flex items-center gap-3">
            
                <p class="text-sm font-semibold leading-none">Admin Panel</p>
                <p class="text-xs text-gray-500">Management</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-6 text-sm">

        <!-- Top links -->
        <div class="space-y-1">
            @foreach($admin_navigation as $item)
                @if($item['top'] === true)
                    <a href="{{ route($item['route_name']) }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-md transition
                       {{ request()->routeIs($item['route_name'])
                            ? 'bg-indigo-50 text-indigo-700 font-medium'
                            : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        {!! $item['icon'] ?? '' !!}
                        <span>{{ $item['name'] }}</span>
                    </a>
                @endif
            @endforeach
        </div>

        <!-- Grouped links -->
        @php
            $grouped = collect($admin_navigation)->where('top', false)->groupBy('group');
        @endphp

        @foreach($grouped as $groupName => $items)
            <div>
                <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-wider text-gray-400">
                    {{ $groupName }}
                </p>

                <div class="space-y-1">
                    @foreach($items as $item)
                        <a href="{{ route($item['route_name']) }}"
                           class="flex items-center gap-3 px-3 py-2 rounded-md transition
                           {{ request()->routeIs($item['route_name'])
                                ? 'bg-gray-100 text-gray-900 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            {!! $item['icon'] ?? '' !!}
                            <span>{{ $item['name'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach

    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-gray-200">
        <form action="{{ route('Administrator.logout') }}" method="POST">
            @csrf
            <button
                class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-md
                       bg-red-50 text-red-700 hover:bg-red-100 transition font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7"/>
                </svg>
                Logout
            </button>
        </form>
    </div>

</aside>
