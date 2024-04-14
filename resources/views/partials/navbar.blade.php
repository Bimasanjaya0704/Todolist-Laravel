<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container">
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-light"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav fs-5">
                <li class="nav-item">
                    <a class="nav-link {{ $title === 'Home' ? 'text-light active' : '' }}" href="/todolist">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title === 'About' ? 'text-light active' : '' }}" href="/about">About</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
