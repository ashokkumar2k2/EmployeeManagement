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
            form{
                border: 1px solid black;
                padding-left: 35px;
                padding-right: 0px;
            }
            .plusandminus{
                margin-right: 5px;
            }
        </style>
    </head>

    <body>


       <div class="d-flex justify-content-center">
    <form action="your_path" method="post" multipart/form-data"  id="addjobs">
        @csrf
        <h2 style="text-align: center">Add Jobs</h2>

<div>
    <div class="mt-5">
        <label for="product_name" class="mx-4" >Job role</label><br>
        <input type="text" name="jobrole" class="mx-4">
    </div><br>

<div>
        <label for="Salary"class="mx-4">Location</label><br>
        <input type="text" name="location"class="mx-4">
    </div><br>

<div>
        <label for="Experience" class="mx-4">Experience</label><br>
      <div>
           <button onclick="decr_experience()" class="plusandminus">-</button>
           <input type="text" name="experience" id="addexp" value="0">
          <button onclick="incr_experience()" class="plusandminus">+</button>  </div>
    </div><br>

<div>
    <label for="Qualification"class="mx-4">Qualification</label><br>
    <input type="text" name="qualification"class="mx-4">
</div><br>

<div>
    
    <label for="Salary" class="mx-4">Salary</label><br>
    <div>
        <button onclick="decr_salary()" class="plusandminus">-</button>
    <input type="number" name="salary" id="addsalary" value="0">
    <button onclick="incr_salary()" class="plusandminus">+</button>
    </div>
</div><br>
<div>
    <label for="image">Image</label><br>
    <input type="file" name="job_image" accept="image/*">
</div><br>


<div class="mt-2">
    <center>
        <input type="submit" class="btn btn-success" value="Addjobs" >
        <a href="/dashboard" class="btn btn-primary">View jobs </a>
        
    </center>
    
</div>


</div>
</form>
</div>



        <script>
            
        $('document').ready(function(){
          $('#addjobs').on('submit',function(event){
            var form = document.getElementById('addjobs');
            var formData = new FormData(form);
            event.preventDefault();
            
          jQuery.ajax({
            url:"{{url('api/uploadjobs')}}",
            data:formData,
            type:'post',
            processData: false,
            contentType: false,

            success:function(result){
               jQuery('#addjobs')[0].reset();
            

            },
            error:function(err){
                console.log(err)
            }

              })
                  })
            })

            function incr_experience(){

                var inputElement = document.getElementById('addexp');
            var value = parseInt(inputElement.value);
            inputElement.value = value + 1;
           }
             
            function decr_experience(){

                    var inputElement = document.getElementById('addexp');
                    var value = parseInt(inputElement.value);

                    if(value > 0)
                    inputElement.value = value - 1;
                    }
                 
     function incr_salary(){

           var inputElement = document.getElementById('addsalary');
          var value = parseInt(inputElement.value);
           inputElement.value = value + 1000;
         }

       function decr_salary(){

           var inputElement = document.getElementById('addsalary');
           var value = parseInt(inputElement.value);

           if(value > 0)
           inputElement.value = value - 1000;
      }
        
            
        </script>
    </body>
</html>
