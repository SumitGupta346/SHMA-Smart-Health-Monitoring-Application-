@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 justify-content-center">
        <div class="col-md-8">
            <h1 style="text-align: center; padding-top:20%;margin-right:10%; color:white;font-size: 40px;">Welcome to SHMA</h1>
            <p>Smart Health Monitoring Application is a smart AI which calculates almost everything you need to take care of your health and is an end user support and online consultation project. </p>

            @guest
            <div class="mt-5" style="text-align: center;">
                <!-- <a href="{{ url('/register') }}"> <button class="btn btn-primary" style=" margin-right: 30px;">Register as Patient</button></a> -->
                <!-- <a href="{{ url('/login') }}"><button class="btn btn-success">Login</button></a> -->
            </div>
            @endguest
        </div>
    </div>

</div>

@endsection
