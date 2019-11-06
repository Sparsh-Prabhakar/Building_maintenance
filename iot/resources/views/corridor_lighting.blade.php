<?php
    use App\lights_status;
    use Illuminate\Support\Facades\DB;
    $a =  DB::select('call gethours');
    $b = DB::select('SELECT min(on_time) as min, max(on_time) as max from corridor_lighting');
    $c = DB::select('SELECT * from eunit');
    $start = $b[0]->min;
    $end = $b[0]->max;
    $ontime = $a[0]->res;
    $onhrs = $ontime/60;
    $bulbwatt = $c[0]->bulbwatt;
    $electricityunit = $c[0]->unit;
    $unitsconsumed= $onhrs* $bulbwatt/1000;
    $totalEstimate = $onhrs * $electricityunit* $bulbwatt/1000;
    $totaltime = $a[0]->mins;
    $totaldays = $totaltime/(24*60);
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
                margin-top: 5%;
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
        <a href="/" class="btn btn-danger" role="button" style="margin:20px">Back</a>
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
        <br><br>
        <div class="container">


            <h2 align = "center">COST ESTIMATE</h2>     
            <p>This Estimate is for last <b>{{floor($totaldays)}}</b> days.</p> 
            <p>This data is recorded from <b>{{$start}}</b> to <b>{{$end}}</b></p> 
            <table class="table table-dark">
              <thead>
                <tr>
                    <th>Bulb number</th>
                  <th>Bulb Watt</th>
                  <th>Bulb On Time(in hrs)</th>
                  <th>Total Units Consumed</th>
                  <th>Cost per unit</th>
                  <th>Total Estimate for Bill in ₹</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>{{$bulbwatt}}</td>
                  <td>{{$onhrs}}</td>
                <td>{{$unitsconsumed}}</td>
                <td>₹{{$electricityunit}}</td>
                <td>{{$totalEstimate}}</td>
                </tr>   
              </tbody>
            </table>
            <h2 align = "center">Power Consumed History</h2> 
            <table class="table table-dark">
                <thead>
                <tr>
                    <th>Day Number</th>
                    <th>Power Consumed</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($power as $id)
                    <tr>
                        <td>{{$id->id}}</td>
                        <td>{{$id->powerConsumed}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        <script>
            setTimeout(function() {
                location.reload();
            }, 100);
        </script>
    </body>
</html>