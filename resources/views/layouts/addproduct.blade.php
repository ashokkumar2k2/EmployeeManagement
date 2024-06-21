<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <style>
            a{
                margin: 5px;
            }
        </style>
    </head>

    <body>


<div class="d-flex justify-content-center">
    <form action="{{url('api/productupload')}}" method="POST" class="form border px-5 py-3 mt-5" id="addproduct">
        @csrf
        <h2 style="text-align: center">Add products</h2>
<div>
    <div class="mt-5">
        <label for="product_name">product name</label><br>
        <input type="text" name="name">
    </div>
<br>
<div>
    <label for="product_name">product price</label><br>
    <input type="text" name="price">
</div><br>
{{-- <div>
    <label for="product_name">Qualification</label><br>
    <input type="text" name="qualification">
</div> --}}

<div>
    <label for="product_name">quantity</label><br>
    <input type="text" name="quantity">
</div><br>
<div class="mt-2">
    <center>
        <input type="submit" class="btn btn-success" value="Addproduct" >
        <a href="/dashboard" class="btn btn-primary">View Bag</a>
        
    </center>
</div>
</div>
</form>
</div>



        <script>
            $('document').ready(function(){
          $('#addproduct').on('submit',function(event){
            event.preventDefault();
          jQuery.ajax({
            url:"{{url('api/productupload')}}",
            data:jQuery('#addproduct').serialize(),
            type:'post',

            success:function(result){
               jQuery('#addproduct')[0].reset();

            },
            error:function(err){
                console.log(err)
            }

              })
                  })
            })
        </script>
    </body>
</html>
