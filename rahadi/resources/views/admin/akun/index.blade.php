<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
</head>
<body>
    <h1>Data User</h1>
    <a href="{{ route('admin.dashboard') }}">Menu Utama</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    <br><br>
    
    <form action="" method="get">
        <label for="cari">Cari:</label>
        <input type="text" name="cari" id="cari">
        <input type="submit" value="Cari">
    </form>
    
    <br><br>
    
    <a href="{{ route('akun.create') }}">Tambah User</a>

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->usertype }}</td>
                <td>
                    <a href="{{ route('akun.edit' , $user->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                    
                    @if($user->usertype == 'siswa')
                    <form onsubmit="return confirm('Jika Akun Siswa Dihapus Maka Data Siswa Akan Ikut Terhapus, Apakah Anda Yakin?');" action="{{ route('akun.destroy',$user->id) }}" method="POST" style="display:inline;">
                    @else 
                    <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('akun.destroy',$user->id) }}" method="POST" style="display:inline;">
                    @endif 
                        @csrf
                        @method('DELETE')
                        <button type="submit">HAPUS</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">
                    <p>Data tidak ditemukan</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $users->links() }}
</body>
</html>
