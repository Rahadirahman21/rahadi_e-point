@extends('auth.layouts')

@section('content')

    <h1>Register</h1>
    <a href="{{ route('login') }}">Login</a>
    <br><br>
    <form action="{{ route('store') }}" method="POST">
        @csrf
        <!-- Nama Lengkap -->
        <label for="name">Nama Lengkap</label><br>
        <input type="text" id="name" name="name" value="{{ old('name') }}"><br>

        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif

        <br>
        <!-- Email Address -->
        <label for="email">Email Address</label><br>
        <input type="email" id="email" name="email" value="{{ old('email') }}"><br>

        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif

        <br>
        <!-- Password -->
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password"><br>

        @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif

     
      
    </form>


@if ($errors->has('password'))
    <span class="text-danger">{{ $errors->first('password') }}</span>
@endif


    <label for="password_confirmation" class="col-md-4 col-form-label text-end">Confirm Password</label>
    <br>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">

<br>
<input type="submit" value="Register">
</form>

@endsection
