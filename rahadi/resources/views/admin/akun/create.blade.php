<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Akun</title>
</head>

<body>
   <h1>Tambah Akun</h1>
   <br><br>
   <a href="{{ route('akun.index') }}">Kembali</a><br><br>

   @if ($errors->any())
   <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
   </div>
   @endif

   <form action="{{ route('akun.store')}}" method="POST" >
    @csrf 
    <label>Nama Lengkap</label><br>
    <input type="text" id="name" name="name" value="{{old('name')}}">
    <br><br>

    <label>Email Address</label><br>
    <input type="email" id="email" name="email" value="{{old('email')}}">
    <br><br>

    <label>Password</label><br>
    <input type="password" id="password" name="password">
    <br><br>
    
     <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
     <div class="col-mid-6">
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
     </div>
     <br><br>

     <label>Hak Akses</label><br>
     <select name="usertype" required>
      <option value="">Pilih Hak Akses</option>
      <option value="admin">Admin</option>
      <option value="ptk">PTK</option>
      
     </select>
     <br><br>

     
     <button type="submit">SIMPAN DATA</button>
     <button type="reset">RESET FORM</button>
   </form>
</body>
</html>
