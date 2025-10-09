<nav class="bg-primary-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <img class="h-8 w-auto" src="{{ asset('logo.png') }}" alt="Logo">
                <span class="ml-3 text-white font-semibold text-lg">{{ $title ?? 'Dashboard' }}</span>
            </div>
            
            @auth
            <div class="flex items-center">
                @php
                    $menuData = json_decode(file_get_contents(resource_path('json/menu.json')), true);
                    $mainMenu = $menuData['main_menu'] ?? [];
                    $userRoles = auth()->user()->getRoleNames()->toArray();
                @endphp
                
                <div class="flex items-center space-x-4">
                    @foreach($mainMenu as $menu)
                        @php
                            $menuRoles = $menu['roles'] ?? [];
                            $showMenu = count(array_intersect($userRoles, $menuRoles)) > 0 || empty($menuRoles);
                            
                            $routeExists = Route::has($menu['route']);
                            $url = $routeExists ? route($menu['route']) : '#';
                            
                            // Check if any child is selected
                            $isChildSelected = false;
                            if (isset($menu['children']) && count($menu['children']) > 0) {
                                foreach ($menu['children'] as $child) {
                                    if (request()->routeIs($child['route'])) {
                                        $isChildSelected = true;
                                        break;
                                    }
                                }
                            }
                        @endphp
                        
                        @if($showMenu)
                        <div class="relative" x-data="{ open: false }">
                            <a href="{{ count($menu['children'] ?? []) > 0 ? '#' : $url }}" 
                               class="{{ request()->routeIs($menu['route']) || $isChildSelected ? 'bg-elephant-700 text-white' : 'text-elephant-200 font-medium hover:text-white hover:bg-elephant-600' }} px-3 py-2 flex items-center rounded-md transition-colors duration-200"
                               @if(count($menu['children'] ?? []) > 0) @click.prevent="open = !open" @endif>
                                <i class="fas fa-{{ $menu['icon'] }} mr-1"></i>
                                {{ $menu['name'] }}
                                @if(count($menu['children'] ?? []) > 0)
                                    <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                         :class="{'transform rotate-180': open}">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </a>
                            
                            @if(count($menu['children'] ?? []) > 0)
                                <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10"
                                     x-show="open"
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95">
                                    @foreach($menu['children'] as $child)
                                        @php
                                            $childRoles = $child['roles'] ?? [];
                                            $showChild = count(array_intersect($userRoles, $childRoles)) > 0 || empty($childRoles);
                                            
                                            $childRouteExists = Route::has($child['route']);
                                            $childUrl = $childRouteExists ? route($child['route']) : '#';
                                        @endphp
                                        
                                        @if($showChild)
                                        <a href="{{ $childUrl }}" class="block px-4 py-2 text-sm {{ request()->routeIs($child['route']) ? 'bg-elephant-100 text-elephant-800 font-medium' : 'text-gray-700 hover:bg-elephant-50 hover:text-elephant-700' }}">
                                            <i class="fas fa-{{ $child['icon'] }} mr-1"></i>
                                            {{ $child['name'] }}
                                        </a>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        @endif
                    @endforeach
                </div>
                
                <div class="ml-4 flex items-center space-x-4">
                    <span class="text-primary-100">Halo, {{ auth()->user()->name }}!</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <x-button type="submit" variant="outline-secondary" size="sm">
                            Logout
                        </x-button>
                    </form>
                </div>
            </div>
            @else
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-primary-100 hover:text-white">Login</a>
                </div>
            @endauth
        </div>
    </div>
</nav>