<!DOCTYPE html>
<html>
<head>
	<title>Kartu Antrian</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <style>
        h1{
            font-size: 50px;
            margin-top: -20px;
        }
    </style>
    <center>
        <p>No Antrian</p>
        <h1>{{$noAntrian}}</h1>
        <p>{{$namaPasien}}</p>
        <p>No. RM: {{$noRM}}</p>
    </center>
</body>
</html>