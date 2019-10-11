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
        </style>
    </head>
    <body>
        <h1>Security</h1>
        <table class="container table">
            <tr class="text-right">
                <th>No.</th>
                <th>Username</th>
                <th>Phone No.</th>
            </tr>
            @foreach($ids as $id)
                <tr class="text-right">
                    <td>{{$id->id}}</td>
                    <td>{{$id->name}}</td>
                    <td>{{$id->phone_no}}</td>
                </tr>
            @endforeach  
            <tr><td></td><td></td><td></td></tr>   
        </table>
        <script>
            setTimeout(function() {
                location.reload();
            }, 100);
        </script>
    </body>
</html>