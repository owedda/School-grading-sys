<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            @if(\Illuminate\Support\Facades\Auth::user()->isTeacher())
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        Students
                    </a>
                    <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="{{ route("users.index") }}" class="nav-link">
                                    <i class="fa fa-address-card-o nav-icon">

                                    </i>
                                    Manage
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("users.create") }}" class="nav-link">
                                    <i class="fa fa-plus-circle nav-icon">

                                    </i>
                                    Add
                                </a>
                            </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route("lessons.index") }}" class="nav-link">
                        <i class="fa fa-book nav-icon">

                        </i>
                        Lessons
                    </a>
                </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->isStudent())
                <li class="nav-item">
                    <a href="{{ route("evaluations.index") }}" class="nav-link">
                        <i class="fa fa-sort-numeric-asc nav-icon">

                        </i>
                        Evaluations
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a href="{{ route('logout')}}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    Logout
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
