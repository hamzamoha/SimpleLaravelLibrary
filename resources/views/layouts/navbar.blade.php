<nav class="navbar bg-dark navbar-expand-lg navbar-dark">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link active">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('books.index') }}" class="nav-link">Books</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('authors.index') }}" class="nav-link">Authors</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @auth('admin')
                    <li class="dropdown nav-item">
                        <a href="#" class="nav-link dropdown-toggle" role="button" id="dropdownSettings"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-1"></i> {{ auth('admin')->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownSettings">
                            <li><a href="{{ route('books.create') }}" class="dropdown-item">+ Book</a></li>
                            <li><a href="{{ route('authors.create') }}" class="dropdown-item">+ Author</a></li>
                            <li><a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a></li>
                            <li><a href="{{ route('settings') }}" class="dropdown-item">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <form action="{{ route('logout') }}" method="POST">
                                <input type="submit" value="Logout" class="dropdown-item">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
