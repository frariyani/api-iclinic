<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <style>
        * {
            box-sizing: border-box;
        }
        /* general styling */
        body {
            font-family: "Open Sans", sans-serif;
        }
        /* Create four equal columns that floats next to each other */
        .column {
            float: left;
            width: 100%;
            padding: 10px;
            border-right: 1px dotted #000;
            height: 100%; /* Should be removed. Only for demonstration */
        }
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        .d-flex{
            display: flex;
        }
        .flex-col{
            flex-direction: column;
        }
        .justify-content-between{
            justify-content: space-between;
        }
        .justify-content-center{
            justify-content: center;
        }
        .justify-content-end{
            justify-content: end;
        }
        .float-right{
            float: right;
        }
        .float-left{
            float: left;
        }
        .circle-logo{
            width: 60px;
        }
        .logo{
            width: 220px;
        }
        .title{
            margin-top: 5px;
        }
        .student-name{
            margin-bottom: 10px;
        }
        .bar-code{
            width: 200px;
            align-self: center;
            margin-top: 5px;
            margin-bottom: 10px;
        }
        .align-center{
            align-self: center;
        }
        /*table*/
        table {
            margin-top: 10px;
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }
        table tr {
            background-color: #fff;
            border: 1px solid #000;
            padding: .35em;
        }
        table th,
        table td {
            padding: .625em;
            border: 1px solid #000;
        }
        /*table end*/
        hr{
            border-top: 1px solid #000;
        }

        h5{
            margin-top: 20px;
            font-size: 18px;
        }
        .payment{
            font-size: 20px;
            margin-top: 10px;
        }
    </style>
    <div class="row">
        <div class="column">
            <center>
                <div class="d-flex flex-col justify-content-center">
                    <h4>Bukti Pembayaran</h4>
                </div>
                <div class="d-flex justify-content-between">
                    <strong>No. Transaksi: {{$payment->paymentCode}}</strong>
                </div>
            </center>
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-col">
                    <span>Tanggal: </span>
                    <span>{{$payment->date}}</span>
                </div>
            </div>

            <h5>Daftar Obat</h5>
            <table>
                <thead>
                    <tr>
                        <th>Nama Obat</th>
                        <th>QTY</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prescriptions as $p)
                    <tr>
                        <td>{{$p->medicineName}}</td>
                        <td>{{$p->pivot->quantity}}</td>
                        <td>{{$p->pivot->subTotal}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <h5>Daftar Perawatan</h5>
            <table>
                <thead>
                    <tr>
                        <th>Nama Perawatan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($treatments as $t)
                    <tr>
                        <td>{{$t->treatmentName}}</td>
                        <td>{{$t->treatmentPrice}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between">
                <strong class="payment">Total:</strong>
                <span class="payment">Rp{{$payment->paymentTotal}}</span>
            </div>
        </div>
    </div>
</body>
</html>