<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan barang Myflorist</title>
    <style>
        body{
            font-size: 15px;
            color: rgb(0, 0, 0);
            display: flex;
            justify-content: center;
        }
        .header{
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid rgb(0, 79, 128);
            padding-bottom: 10px;
        }
        .title{
            font-size: 20px;
            font-weight: bold;
        }
        .table{
            display: flex;
            justify-content: center;
            width: 100%;
            border-collapse: collapse;    
        }
        th{
            text-align: center;
            background-color: rgb(231, 200, 27);
            font-weight: bold;
            border: 1px solid rgb(0, 0, 0);
            padding: 8px;
        }
        td{
            border: 1px solid aliceblue;
            padding: 8px;
            border: 1px solid rgb(0, 0, 0);
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN DATA BARANG Myflorist</div>
        <p>Dicetak dari Sistem</p>
    </div>
    <table align="center">
        <thead>
            <tr>
                <th style="width: 5%">NO</th>
                <th>Nama bunga</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $p)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->stok }}</td>
                    <td>Rp. {{number_format($p->harga,0,',','.')}}</td>
                    <td>{{ $p->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>