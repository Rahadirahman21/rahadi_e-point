<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Pelanggaran</title>
</head>

<body>
   <h1>Tambah Pelanggaran</h1>
   <br><br>
   <a href="{{ route('pelanggaran.index') }}">Kembali</a><br><br>

   @if ($errors->any())
   <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
   </div>
   @endif

   <form action="{{ route('pelanggaran.store')}}" method="POST" >
    @csrf 
    <label>Jenis Kelamin</label><br>
    <textarea id="jenis" name="jenis" rows="7" cols="50" value="{{old('jenis')}}"></textarea>
    <br><br>

    <label>Konsekuensi</label><br>
    <textarea id="konsekuensi" name="konsekuensi" rows="7" cols="50" value="{{old('konsekuensi')}}"></textarea>
    <br><br>

    <label>poin</label><br>
    <input type="text" name="poin" id="poin" value="{{old('poin') }}"><br>
    <br><br>

     <input type="submit" value="Register">
   </form>
</body>
</html>
