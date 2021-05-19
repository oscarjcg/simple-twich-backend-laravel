<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Dashboard</li>

            <li>
                <a href="{{ route('home') }}">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

            <li class="app-sidebar__heading">Categories</li>

            <li>
                <a href="{{ route('categories.index') }}">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Categories
                </a>
            </li>
            <li>
                <a href="{{ route('categories.create') }}">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Create Category
                </a>
            </li>

            <li class="app-sidebar__heading">Channels</li>

            <li>
                <a href="{{ route('channels.index') }}">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Channels
                </a>
            </li>
            <li>
                <a href="{{ route('channels.create') }}">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Create Channel
                </a>
            </li>


        </ul>
    </div>
</div>
