<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">

        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" aria-current="page" href="{{ route('admin.index') }}">
                        @if(request()->routeIs('admin.index'))
                            <svg class="bi"><use xlink:href="#house-fill"/></svg>
                        @else
                            <svg class="bi"><use xlink:href="#house"/></svg>
                        @endif
                        Главная админка
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#">
                        <svg class="bi"><use xlink:href="#file-earmark"/></svg>
                        Категории
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.news.index') }}">
                        @if(request()->routeIs('admin.news.index'))
                            <svg class="bi"><use xlink:href="#cart-fill"/></svg>
                        @else
                            <svg class="bi"><use xlink:href="#cart"/></svg>
                        @endif
                        Новости
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.users') }}">

                        @if(request()->routeIs('admin.users'))
                            <svg class="bi"><use xlink:href="#people-fill"/></svg>
                        @else
                            <svg class="bi"><use xlink:href="#people"/></svg>
                        @endif
                        Пользователи
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.parser') }}">
                        <svg class="bi"><use xlink:href="#graph-up"/></svg>
                        Парсер
                    </a>
                </li>


            </ul>

            <hr class="my-3">

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#">
                        <svg class="bi"><use xlink:href="#gear-wide-connected"/></svg>
                        Профиль
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <svg class="bi"><use xlink:href="#door-closed"/></svg>
                        Выход
                    </a>



                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
