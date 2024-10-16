<!DOCTYPE html>
<html lang="en">
{{-- HEAD --}}
@include('partials.head')
<body id="body-admin">
    {{-- SIDEBAR ADMIN --}}
    @include('partials.sidebar-admin')

    <main class="main-admin-container" id="main-admin-container">
        {{-- NAVBAR ADMIN --}}
        @include('partials.navbar-admin')
        {{-- SIDEBAR INFO ADMIN --}}
        @include('partials.profile-info')

        {{-- CONTENIDO DE VISTAS HIJAS ADMIN --}}
        @yield('admin-content')
    </main>

</body>

    @yield('js')

</html>
