@extends('layout/layout-common')


@section('space-work')

<!-- <h1>Login</h1> -->





<!-- <form action="{{route('userLogin')}}" method="POST"> -->

    <!-- @csrf -->
<!--
    <input type="email" name="email" placeholder="Entter your Email"><br><br>
    <input type="password" name="password" placeholder="Entter your Password"><br><br>
    <input type="submit" name="login" value="Login">


</form>

<a href="/forget-password">Forget Password</a>

 -->

<style>


*{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body{
    font-family: 'Libre Franklin', sans-serif;
}

h1 {
    font-weight: bold;
    margin: 0;
    margin-bottom: 1rem;
}

p {
    font-size: 14px;
    font-weight: 100;
    line-height: 20px;
    letter-spacing: 0.5px;
    margin: 20px 0 30px;
}

span {
    font-size: 12px;
}

a {
    color: #333;
    font-size: 14px;
    text-decoration: none;
    margin: 15px 0;
}


.btn-grad {background-image: linear-gradient(to right, #6441A5 0%, #2a0845  51%, #6441A5  100%)}
.btn-grad {
   margin: 10px;
   padding: 15px 45px;
   text-align: center;
   text-transform: uppercase;
   transition: 0.5s;
   background-size: 200% auto;
   color: white;
   border-radius: 10px;
   display: block;
   cursor: pointer;
}

.btn-grad:hover {
    background-position: right center; /* change the direction of the change here */
    color: #fff;
    text-decoration: none;
}

#signIn{
    background-image: linear-gradient(to right, #fff 0%, #f7f3f3  51%, #fff  100%);
    color: #6441A5;
}

#signUp{
    background-image: linear-gradient(to right, #fff 0%, #f7f3f3  51%, #fff  100%);
    color: #6441A5;
}

form {
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 50px;
    height: 100%;
    text-align: center;
}

input {
    background-color: #eee;
    border: none;
    padding: 12px 15px;
    margin: 8px 0;
    width: 100%;
}

/*  */
.body-container{
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #4568DC;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #B06AB3, #4568DC);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #84a0ff, #efefef); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}
.container {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.25), 0 5px 5px rgba(0, 0, 0, 0.22);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
}

/*  */


.form-container {
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-in-container {
    left: 0;
    width: 50%;
    z-index: 2;
}

.sign-up-container {
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}

.container.right-panel-active .sign-in-container {
    transform: translateX(100%);
}

.container.right-panel-active .sign-up-container {
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: show 0.6s;
}

@keyframes show {
    0%,
    49.99% {
        opacity: 0;
        z-index: 1;
    }

    50%,
    100% {
        opacity: 1;
        z-index: 5;
    }
}

.overlay-container {
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: transform 0.6s ease-in-out;
    z-index: 100;
}

.container.right-panel-active .overlay-container {
    transform: translateX(-100%);
}

.overlay {
    background: #6441A5;
    background: -webkit-linear-gradient(to right, #6441A5, #2a0845);
    background: linear-gradient(to right, #6441A5, #2a0845);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: 0 0;
    color: #ffffff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: transform 0.6s ease-in-out;
}

.container.right-panel-active .overlay {
    transform: translateX(50%);
}

.overlay-panel {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    text-align: center;
    top: 0;
    height: 100%;
    width: 50%;
    transform: translateX(0);
    transition: transform 0.6s ease-in-out;
}

.overlay-left {
    transform: translateX(-20%);
}

.container.right-panel-active .overlay-left {
    transform: translateX(0);
}

.overlay-right {
    right: 0;
    transform: translateX(0);
}

.container.right-panel-active .overlay-right {
    transform: translateX(20%);
}


</style>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300&display=swap" rel="stylesheet">
    <title>Login Page | QuizzUP</title>
</head>
<body>
    <div class="body-container">
    <div class="container" id="container">
        <div>

        <div class="form-container sign-in-container">
            <form action="{{route('userLogin')}}" method="POST">
                @csrf
                <h1>Sign In</h1>
                <input type="email" name="email" placeholder="Email" required/>
                <input type="password" name="password" placeholder="Password" required/>
                <a href="/forget-password">Forgot your password?</a>
                <input type="submit" name="login" value="Login" class="btn-grad">
                <!-- <div class="btn-grad" >Sign In</div> -->

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

            </form>
        </div>
        </div>

        <div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 style="text-shadow:3px 3px 7px black;color:#9f9f9f">QuizzUP</h1>
                    <h6 style="color:grey">QuizzUP - A Quiz Application</h6>
                </div>
            </div>
        </div>
        </div>
    </div>

    </div>
    <!-- <script type="text/javascript" src="index.js"></script> -->
</body>
</html>






@endsection



