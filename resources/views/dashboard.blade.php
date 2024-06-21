<?php
use App\Http\Controllers\searchjobs;
use Illuminate\Support\Facades\Auth;
$total = searchjobs::watchlist();
?>


<!doctype html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}" class="light">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        body {
            background-color: white !important;
        }

        /* #button {
            /* margin-left: auto !important; */
        display: flex !important;
        justify-content: flex-end !important;
        }

        .addjobs {
            display: flex;
            justify-content: flex-end;

        }


        img {
            width: 100% !important;

            max-height: 150px;

            width: auto;
            /* Ensure the width adjusts proportionally */
            height: auto;
        }

        hr {
            border: none;
            border-bottom: 2px solid #333;
            /* Customize the underline color and thickness */
            margin: 0;
            /* Remove default margin */
        }

        .card {

            border: 1px solid black;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1) !important;
            border-radius: 10px;
            transition: transform 0.2s ease-in-out;
        }

        .card:hover,
        .card:focus {
            transform: scale(1.05);
            /* Zoom effect on hover or focus */
        }
        .admin{
            justify-content: flex-end;
        }
        
    </style>
</head>

<body class="bg-light">
    <x-app-layout>
        <hr>
        @if (session('error'))
            <div class="alert alert-danger col-12 text-center" id="flash-message">
                {{ session('error') }}
            </div>
        @elseif(session('success'))
            <div class="alert alert-success col-12 text-center" id="flash-message">
                {{ session('success') }} </div>
        @endif


        @if (session('watchlistsuccess'))
            <div class="alert alert-success col-12 text-center" id="flash-message">
                {{ session('watchlistsuccess') }}
            </div>
        @endif


        @if (Auth::user()->email == 'admin@gmail.com')
            <div class="addjobs">
                <a href="/addjobs" class="btn btn-outline-info mx-3 mt-4 admin">Add jobs</a>
            </div>
        @else
        @endif

        @if (Auth::user()->email == 'admin@gmail.com')
        @else
            <div class="input-append d-flex justify-content-end align-items-center m-2" id="button">
                <a href="/watchlist"
                    class="btn btn-primary active icon-white icon-plus mx-2 ">watchlist({{ $total }})</a>
                <a href="/viewjobsapplied" class="btn btn-success active icon-white icon-plus mx-2">Applied
                    Jobs</a>
            </div>
        @endif

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12">
                    <div class="container d-flex flex-wrap justify-content-center align-items-center">
                        @foreach ($jobs as $jobs)
                            <div class="card m-3 p-3" id="zoomCard">
                                <img class="card-img-top" src="image\{{ $jobs->job_image }}" alt="">
                                <div class="card-body ">
                                    <h4 class="card-text">Job: {{ $jobs->job_role }}</h4>
                                    <p class="card-text">Location: {{ $jobs->location }}</p>
                                    <p class="card-text">Experience: {{ $jobs->experience }}</p>
                                    <p class="card-text">Qualification: {{ $jobs->qualification }}</p>
                                    <p class="card-text">Salary: {{ $jobs->salary }}</p>
                                    <form action="/addtowatchlist" method="POST">
                                        @csrf
                                        <input type="hidden" name="jobid" value="{{ $jobs->id }}">
                                        <input type="submit" class="btn btn-primary text-dark mt-2 px-2"
                                            value="Add to watchlist" style="background-color: rgb(0, 204, 255)">

                                    </form>
                                    <form action="/jobsapplied" method="POST">
                                        @csrf
                                        <input type="hidden" name="job_id" value="{{ $jobs->id }}">
                                        <input type="submit" class="btn btn-success text-dark mt-2 px-5" value="Apply"
                                            style="background-color: rgb(0, 255, 85)">
                                    </form>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>

        </div>






    </x-app-layout>


    <!-- Bootstrap JavaScript Libraries -->
    <script>
        //  document.addEventListener('DOMContentLoaded', function () {




        setTimeout(function() {
            var flashMessage = document.getElementById('flash-message');
            flashMessage.style.display = 'none';
        }, 3000);

        const card = document.getElementById('zoomCard');
        card.addEventListener('touchstart', function() {
            this.style.transform = 'scale(1.05)';
        });
        card.addEventListener('touchend', function() {
            this.style.transform = 'scale(1)';
        });
    </script>
</body>

</html>
