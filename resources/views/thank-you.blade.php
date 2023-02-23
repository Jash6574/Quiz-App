@extends('layout/layout-common')


@section('space-work')

    <div class="container">
        <div class="text-center"><br><br><br>
            <h2>Thank you!!! {{ Auth::user()->name }}</h2>
            <h4>Your response has been recorded</h4>
            <p>We will review your response and update you very soon as possible via mail.</p>
            <a href="/dashboard" class="btn btn-info">Home</a>
        </div>
    </div>

@endsection
