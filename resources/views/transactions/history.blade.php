<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Riwayat Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body class="bg-gray-100">
    @include ('navbar')
    <div class="max-w-6xl mx-auto bg-white rounded shadow-sm mt-6">
        <h2 class="text-xl font-bold mb-6 text-gray-800 flex items-center gap-2">
            <span class="material-icons text-red-500">
                history
            </span>Riwayat Transaksi Penjualan
        </h2>
        @if ($history->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <span class="material-icons text-5xl mb-2">receipt_long</span>
                <p class="text-sm">Belum ada Riwayat</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-800">
                            <th class="p-4">Waktu Transaksi</th>
                            <th class="p-4">No nota</th>
                            <th class="p-4">Daftar Item & qty</th>
                            <th class="p-4">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y">
                        @foreach ($history as $h)
                          <tr>
                            <td class="p-4 text-green-400"> {{ $h->created_at->format('d M Y - H:i') }} WIB</td>
                            <td class="p-4 text-blue-400"> {{ $h->no_nota }} </td>
                            <td class="p-4">
                                @foreach ($h->details as $detail)
                                    <div class="bg-amber-200 text-gray-500 px-2 py-1 rounded">
                                        {{ $detail->product->nama_barang??'Produk Dihapus' }}
                                        <span class="text-black-100 font-bold">{{ $detail->qty }}</span>
                                    </div>
                                @endforeach
                            </td>
                            <td>
                                Rp. {{ number_format($h->total_harga,0,',','.') }}
                            </td>
                            </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>