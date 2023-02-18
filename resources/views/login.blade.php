@extends('layout/layout-common')


@section('space-work')

<h1>Login</h1>


<!-- displaying erre sentences -->

@if($errors->any())
    @foreach($errors->all() as $error)
        <p style="color:red">{{ $error }}</p>
    @endforeach
@endif

<!-- displaying erre sentences -->
@if(Session::has('error'))
        <p style="color:red">{{ Session::get('error') }}</p>
    @endif


<form action="{{route('userLogin')}}" method="POST">

    @csrf

    <input type="email" name="email" placeholder="Entter your Email"><br><br>
    <input type="password" name="password" placeholder="Entter your Password"><br><br>
    <input type="submit" name="login" value="Login">


</form>

<a href="/forget-password">Forget Password</a>

@endsection
