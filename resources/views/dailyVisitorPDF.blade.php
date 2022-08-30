<!DOCTYPE html>
<html>
<head>
	<title>Laporan Kunjungan Harian</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            margin-bottom: 100px;
            width: 100%;
            margin-left: 100px;
        }

        li {
            float: left;
            height: 100px;
        }

        li a {
            margin: auto;
            display: block;
            text-decoration: none;
            padding: 12px 18px;
            color: black;
        }
	</style>
    <center>
        <img src="{{ public_path('iClinicLogo.png') }}" style="width: 60px; height: 60px">
        <h4>Laporan Kunjungan Harian {{$month}}</h4>
    </center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
                <th>No.</th>
				<th>Tanggal</th>
				<th>Kunjungan Harian</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($visitors as $v)
			<tr>
				<td>{{ $i++ }}</td>
                <td>{{$v->date}}</td>
				<td>{{$v->visitors}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>