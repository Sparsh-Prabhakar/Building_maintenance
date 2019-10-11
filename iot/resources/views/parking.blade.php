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
                text-align: center;
            }
        </style>    
    </head>
    <body> 
        <h1>Parking System</h1>  
        <br><br>
        <h3>Parking Slots</h3>
        <br>
        <div class="row" style="margin-left:36%">
            @foreach($ids as $id)
                @if($id->filled == 1)
                    <img src="/images/carParked.jfif" alt="photo">
                @else
                    <img src="/images/parkingClear.jfif" alt="photo">
                @endif
            @endforeach
        </div>
        <script>
            setTimeout(function() {
                location.reload();
            }, 100);
        </script>   
    </body>
</html>