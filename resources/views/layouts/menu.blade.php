@if (auth()->user()->role == 'Admin')
    @include('layouts.menu.admin')
@endif
