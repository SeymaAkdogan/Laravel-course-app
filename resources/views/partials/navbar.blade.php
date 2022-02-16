<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Course App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/courses">Courses</a>
                </li>
            </ul>

            <form action="/courses" class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name='search' value="">
                <button class="btn btn-outline-danger" type="submit"><i class="fas fa-search"></i></button>
            </form>

            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
            @auth
                <li class="nav-item">
                    <a href="/profile" class="nav-link">
                        My Profile
                    </a>
                </li>
                @if(Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users">Users</a>
                    </li>
                    <li class="nav-item">
                    <a href="/create-course" class="nav-link">Create Course</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout, {{ Auth::user()->firstname }}</a>
                </li>
            @endauth

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>
            @endguest


            </ul>
        </div>
    </div>
</nav>
