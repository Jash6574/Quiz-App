
@extends('layout/layout-common')


@section('space-work')

<h1>Reset Password</h1>


<!-- displaying erre sentences -->

@if($errors->any())
    @foreach($errors->all() as $error)
        <p style="color:red">{{ $error }}</p>
    @endforeach
@endif

<form action="{{route('resetPassword')}}" method="POST">

    @csrf

    <input type="hidden" name='id' value="{{ $user[0]['id'] }}">
    <input type="password" name="password" placeholder="Enter your Password" required><br><br>
    <input type="password" name="password_confirmation" placeholder="Enter Confirm Password" required><br><br>
    <input type="submit" value="Reset Password">


</form>

<!-- <a href="/">Login</a> -->




@endsection
