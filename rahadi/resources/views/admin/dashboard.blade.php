<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
</head>

<body>
    <h1>Dashboard Admin</h1>

    <!-- Logout Link -->
     <a class="nav-link" href="{{ route('siswa.index')}}">Data Siswa</a>
     <a class="nav-link" href="{{ route('akun.index')}}">Data Akun</a>
     <a class="nav-link" href="{{ route('pelanggaran.index') }}">Data Pelanggaran</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Success Message -->
    @if (Session::get('success'))
        <p>{{ Session::get('success') }}</p>
    @else
        <p>You are logged in!</p>
    @endif
</body>

</html>
