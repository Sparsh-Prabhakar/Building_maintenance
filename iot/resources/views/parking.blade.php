<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style>
            table{
                margin-top: 2%;
            }
            h1{
                text-align: center;
                margin-top: 10%;
            }
            .jumbotron{
                margin-left:10%;

            }
            h3{
                margin-left:46%;
            }
        </style>    
    </head>
    <body> 
        <h1>Parking System</h1>  
        <br><br>
        <h3>Parking Slots</h3>
        <br>
        <div class="row" style="margin-left:32%">
            @foreach($ids as $id)
                @if($id->filled == 1)
                    <div class="jumbotron" style="background-color: red;color:white;padding:5%"><h1>{{$id->id}}</h1></div>
                @else
                    <div class="jumbotron" style="background-color: green;color:white;padding:5%"><h1>{{$id->id}}</h1></div>
                @endif
            @endforeach
        </div>
        <script>
            setTimeout(function() {
                location.reload();
            }, 1000);
        </script>   
    </body>
</html>