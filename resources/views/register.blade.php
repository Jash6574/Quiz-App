@extends('layout/layout-common')


@section('space-work')

<h1>Register</h1>


<!-- displaying erre sentences -->

@if($errors->any())
    @foreach($errors->all() as $error)
        <p style="color:red">{{ $error }}</p>
    @endforeach
@endif


<form action="{{route('studentRegister')}}" method="POST">

    @csrf

    <input type="text" name="name" placeholder="Entter your Name"><br><br>
    <input type="email" name="email" placeholder="Entter your Email"><br><br>
    <input type="password" name="password" placeholder="Entter your Password"><br><br>
    <input type="password" name="password_confirmation" placeholder="Entter your Confirm Password"><br><br>
    <input type="submit" name="submit" value="Register">


</form>

<!-- displaying erre sentences -->
    @if(Session::has('success'))
        <p style="color:green">{{ Session::get('success') }}</p>
    @endif


@endsection
