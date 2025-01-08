@extends('auth.layouts')

@section('content')
    <div class="card bg-slate-200 w-96 flex justify-center items-center">
    <div class="card-body">
    <h1 class="text-5xl font-extrabold">Login</h1>
    
    <br><br>
    <form action="{{ route('authenticate') }}" method="post">
        @csrf
        <label for="email">Email Address</label><br>
        <input type="email" id="email" name="email" value="{{ old('email') }}"><br><br>
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
    </div>
    </div>

@endsection
