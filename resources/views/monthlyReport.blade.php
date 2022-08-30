<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pendapatan Harian</title>
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
        <h3>Laporan Bulanan</h3>
        <h4>Bulan {{$date}}</h4>
    </center>

    <left>
        <p class="bg-info">Pendapatan Bulanan: Rp{{$monthlyIncome}}</p>
        <p class="bg-info">Kunjungan Bulanan: {{$monthlyVisitor}}</p>
    </left>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
                <th>No.</th>
				<th>Nama Obat</th>
				<th>Penggunaan</th>
                <th>Stok</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($medicineUsage as $u)
			<tr>
				<td>{{ $i++ }}</td>
                <td>{{$u->medicineName}}</td>
				<td>{{$u->med_usage}}</td>
                <td>{{$u->supply}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>