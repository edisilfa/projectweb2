<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan produk Tokoroti</title>
    <style>
        body{
            font-size: 12px;
            color: rgb(0, 0, 0);
        }
        .header{
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid green;
            padding-bottom: 10px;
        }
        .title{
            font-size: 18px;
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
            background-color: azure;
            font-weight: bold;
            border: 1px solid aliceblue;
            padding: 8px;
        }
        td{
            text-align: center;
            border: 1px solid aliceblue;
            padding: 8px;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN DATA PRODUK TOKOROTI</div>
        <p>Dicetak oleh sistem, kalo salah salahin yang bikin sistem</p>
    </div>
    <table>
        <thead>
            <tr>
                <th style="width: 5%">NO</th>
                <th>Nama Produk</th>
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