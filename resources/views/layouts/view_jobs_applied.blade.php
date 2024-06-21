<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        .head {
            color: rgb(0, 0, 0);
            size: 100cm !important;
            font-weight: bold;
            margin-top: 5px !important;
        }

        .dashboard_button {
            display: flex;
            justify-content: flex-end;
            align-items: flex-start;

        }

        .border {
            border: 1px solid black !important;
        }

        @media (max-width: 650px) {
            .card {
                width: 100%;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1) !important;
                border-radius: 10px;
                transition: transform 0.2s ease-in-out;
            }
        }
        .card:hover,
        .card:focus {
            transform: scale(1.05);
            /* Zoom effect on hover or focus */
        }

        hr {
            border: none;
            border-bottom: 2px solid #333;
            /* Customize the underline color and thickness */
            margin: 0;
            /* Remove default margin */
        }
    </style>

</head>

<body>
    <x-app-layout>
        <hr>
        <center>
            <h1 class="head">Applied Jobs</h1>
        </center>
        <div class="container d-flex flex-wrap mt-5 justify-content-center ">
            @foreach ($viewjobsapplied as $viewjobsapplied)
                <div class="card border text-left m-3 p-3 d-flex">
                    <img class="card-img-top" src="holder.js/100px180/" alt="">
                    <div class="card-body">
                        <p class="card-text">Job: {{ $viewjobsapplied->job_role }}</p><br>
                        <p class="card-text">Location: {{ $viewjobsapplied->location }}</p><br>
                        <p class="card-text">Experience: {{ $viewjobsapplied->experience }}</p><br>
                        <p class="card-text">Qualification: {{ $viewjobsapplied->qualification }}</p><br>
                        <p class="card-text">Salary: {{ $viewjobsapplied->salary }}</p>
                        <form action="/view_status">
                            <input type="submit" class="btn btn-success text-dark mt-2 px-5" value="view status"
                                style="background-color: rgb(0, 255, 221)">
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="dashboard_button">
            <a href="/dashboard" class="btn btn-secondary mx-4" style="background-color: #00ff80">Back to dashboard</a>
        </div>

    </x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
