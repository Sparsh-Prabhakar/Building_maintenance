<html>
    <head>
        {{-- <link rel="stylesheet" href=""> --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style>
            body{
                background-color: khaki;
            }
            .jumbotron{
                margin-left:2.5%;
                margin-top:15%;  
                width:30%; 
                height:100%; 
            }
            .row{
                height:40%;
                background-color: bisque;
            }
            .btn{
                margin-top: 10%;
                margin-left: 40%; 
            }
            h1{
                text-align: center;
            }
            a{
                color:white;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="jumbotron">
                <div class="button col-lg-12 col-md-12 col-sm-12">
                    <h1>Parking</h1>
                    <a href="/parking"><Button class="btn btn-success btn-lg">Parking</Button></a>
                </div>
            </div>
            <div class="jumbotron">
                <div class="button col-lg-12 col-md-12 col-sm-12 ">
                    <h1>Corridor Lighting</h1>
                    <a href="/corridor_lighting"><Button class="btn btn-success btn-lg">Corridor Lighting</Button></a>
                </div>
            </div>
            <div class="jumbotron">
                <div class="button col-lg-12 col-md-12 col-sm-12 ">
                    <h1>Security</h1>
                    <a href="/security"><Button class="btn btn-success btn-lg">Security</Button></a>
                </div>
            </div>
        </div>
    </body>
</html>