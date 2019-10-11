<?php
    use App\lights_status;
?>
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
            .row{
                margin-left:0%;
                width:60%;
                margin-left:20%;
                padding-top: 1.5%;
                padding-left: 10%; 
            }
        </style>
    </head>
    <body>
        <h1>Corridor Lighting</h1>
        <br><br>
        <div class="row">
            <?php $cid = lights_status::find(1)?>
            @if($cid->status == 1)
                <style>.row{background-color: rgba(242,255,22,0.4)}</style>
            @else
                <style>.row{background-color: rgba(178, 179, 161,0.3)}</style>
            @endif
            @foreach($lid as $id)
                @if($id->light_no!=1)
                    @if($id->status == 1)
                        <div class="jumbotron" style="background-color:yellow;color:white;margin-right:5%; width:16%"><h1>{{$id->light_no-1}}</h1></div>
                     @else
                        <div class="jumbotron" style="background-color: gray;color:white;margin-right:5%;width:16%"><h1>{{$id->light_no-1}}</h1></div>
                    @endif
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