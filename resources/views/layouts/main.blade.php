
{{-- directivas --}}

<!DOCTYPE html>
<html lang="en">
{{-- MODULO HEAD --}}
@include('partials.head')
<body class="body-users">
    {{-- MODULO HEADER --}}
    @include('partials.header')

    {{-- VISTAS HIJAS USUARIOS --}}
    <main class="main-container">
        @yield('users-content')
    </main>

    {{-- MODULO FOOTER --}}
    @include('partials.footer')
</body>
</html>


