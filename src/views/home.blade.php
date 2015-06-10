@extends('layouts.home')

@section('header-styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="css/app.css">
@stop

@section('home-extras')
    <div class="row tagline-row">
        <div class="col-md-10">
            <h1>Your future apartment<br>is just around the corner</h1>
        </div>
    </div><!--end row-->

    <div class="row tagline-button-row">
        <div class="col-sm-3">
            <a href="/search"><button class="button-style-1">Search Rentals</button></a>
        </div>

        <div class="col-sm-3">
            <a href="/contact"><button class="button-style-3">Get in touch</button></a>
        </div>
    </div><!--end row-->
@stop

@section('location')
    <div class="col-sm-9">
        <h2>Right in Downtown Boone</h2>
        <p>All of our apartments are located in downtown Boone right next to campus, and in general, we are closer to the classrooms than the dorms</p>
    </div>
    <div class="col-sm-3 button-col">
        <a href="/map"><button class="button-style-2" id="see-map-button">See Map</button></a>
    </div>
@stop
