<form class="search-form d-flex justify-content-center" action="{{route('search')}}" method="GET">
    <input class="form-control me-2 the-search" type="search" placeholder="Search" aria-label="Search" name="search">
    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
</form>

@yield('search')
