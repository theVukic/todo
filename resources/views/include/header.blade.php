<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid"> <a class="navbar-brand" href="{{route('home')}}">To Do Aplikacija</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="ms-auto d-flex gap-2">
                    <a class="btn btn-outline-success" href="{{ route('task.add') }}">Dodaj Zadatak</a>
                    <a class="btn btn-outline-danger" href="{{ route('logout') }}">Odjava</a>
                </div>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</header>
