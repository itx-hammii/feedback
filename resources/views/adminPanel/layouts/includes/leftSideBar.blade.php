<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link @if(Request::route()->getName() == 'home') active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('product.index')}}" class="nav-link @if(Request::route()->getName() == 'product.index') active @endif">
                <i class="nav-icon fa-solid fa-users"></i>
                <p>
                    Products
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('user.index')}}" class="nav-link @if(Request::route()->getName() == 'user.index') active @endif">
                <i class="nav-icon fa-solid fa-users"></i>
                <p>
                    Users
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link @if(Request::route()->getName() == 'setting.index') active @endif">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                    Setting
                </p>
            </a>
        </li>
        <li class="nav-item text-light" style="bottom: 0;   position: fixed;">
            <a  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>
<form action="{{ route('logout') }}"  id="logout-form" method="post">
    @csrf
</form>
