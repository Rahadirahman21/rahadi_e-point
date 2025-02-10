<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Siswa; // Import Siswa model
use Illuminate\Support\Facades\DB; // Import DB facade
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class LoginRegisterController extends Controller
{
    public function index()
    {
        // Get data dari database
        $users = User::latest()->paginate(10);

        // Kirim data ke view
        return view('admin.akun.index', compact('users'));
    }

    public function create()
    {
        return view('admin.akun.create');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => 'admin'
        ]);
        return redirect()->route('akun.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // Validasi data input login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek tipe user dan arahkan ke dashboard yang sesuai
            if ($request->user()->usertype == 'admin') {
                return redirect('admin/dashboard')->with('success', 'You have successfully logged in!');
            }
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Invalidate session
        $request->session()->invalidate();

        // Regenerate session token
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have logged out successfully!');
    }

    public function edit($id)
    {
        // Ambil data user berdasarkan ID
        $akun = User::findOrFail($id);

        // Kirim data ke view dengan compact
        return view('admin.akun.edit', compact('akun'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:250',
            'usertype' => 'required',
        ]);

        // Cari user berdasarkan ID
        $datas = User::findOrFail($id);

        // Update data user
        $datas->update([
            'name' => $request->name,
            'usertype' => $request->usertype,
        ]);

        return redirect()->route('akun.edit', $id)->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function updateEmail(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|max:250|unique:users',
        ]);

        // get post by ID 
        $datas = User::findOrFail($id);
        //edit akun

        $datas->update([
            'email' => $request->email,
        ]);

        return redirect()->route('akun.edit', $id)->with(['success' => 'Email Berhasil Diubah!']);
    }

    public function updatePassword(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        // get post by ID 
        $datas = User::findOrFail($id);
        //edit akun

        $datas->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('akun.edit', $id)->with(['success' => 'Password Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        // Cari ID siswa
        $siswa = DB::table('siswas')->where('id_user', $id)->value('id');

        // Jika siswa ditemukan, hapus data siswa
        if ($siswa) {
            $this->destroySiswa($siswa);
        }

        // Hapus data user berdasarkan ID
        $post = User::findOrFail($id);
        $post->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('akun.index')->with(['success' => 'Akun Berhasil Dihapus!']);
    }

    public function destroySiswa(string $id)
    {
        // Cari ID siswa
        $post = Siswa::findOrFail($id);

        // Hapus gambar terkait siswa
        Storage::delete('public/siswas/' . $post->image);

        // Hapus data siswa
        $post->delete();
    }
}
