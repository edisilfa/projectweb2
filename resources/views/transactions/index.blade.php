<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body class="bg-gray-100">
    @include('navbar')
    <div class="max-w-xl bg-white p-6 rounded shadow-sm mt-10">
        <h1 class="text-xl font-bold text-gray-900 flex items-center gap-2">
            <span class="material-icons text-blue">
                shopping_cart
            </span>Input Transaksi
        </h1>
        @if (session('success'))
            <div class="bg-green-100 border-green-400 text-green-800 px-4 py-2 text-sm mb-4">
                {{ session('success') }}
            </div>
        @endif
        @error('qty_error')
            <div class="bg-white-100 border-red-400 text-red-800 px-4 py-2 text-sm mb-4">
                {{ $message }}
            </div>    
        @enderror
    </div>
    <form action="{{ route('transaction.store') }}" method="post">
        @csrf

        <label for="product_id" class="text-gray-800 block mb-1">Pilih Barang</label>
        <select name="product_id" class="border p-2 mb-4 rounded bg-amber-200" focus:bg-white>
        <option value="">--Pilih Item--</option>
        @foreach ($products as $p)
            <option value="{{ $p->id }}">
                {{ $p->nama_barang }} (stok: {{ $p->stok }}) - Rp {{ number_format($p->harga,0,',','.') }}
            </option>
        @endforeach
        </select>
        <label for="qty" class="text-gray-800 block mb-1"></label>
        <input type="number" name="qty" min="1" value="1" class="border p-2 mb-5 rounded bg-amber-200" focus:bg-white">
        <br>
        <button type="submit" class="bg-blue-400 hover:bg-emerald-500 text-white py-2.5 rounded font-medium">
            <span class="material-icons text-lg">save</span> Simpan Transaksi
        </button>
    </form>
</body>
</html>