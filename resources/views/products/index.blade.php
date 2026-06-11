<html>
    <head>
        <title>Tabel barang</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <body class="p-4">
       @include('navbar')
        <button onclick="toggle_modal()" class="bg-green-500 text-white px-4 py-3 rounded-2xl">+ Tambah barang</button>
        <table class="table-auto w-full mt-5">
            <thead>
                <tr class="bg-blue-200">
                    <th class="border p-2">Nama Roti</th>
                    <th class="border p-2">Harga</th>
                    <th class="border p-2">Stok</th>
                    <th class="border p-2">Deskirpsi</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                    <tr>
                        <td class="border p-2">{{ $p->nama_barang }}</td>
                        <td class="border p-2">Rp. {{ number_format($p->harga,0,',','.') }}</td>
                        <td class="border p-2">{{ $p->stok }}</td>
                        <td class="border p-2">{{ $p->deskripsi }}</td>
                        <td class="border p-2 text-center">
                            <div class="flex items-center justify-center gap-4">
                                <button onclick="toggle_edit({{ $p }})" class="text-blue-500 font-medium">
                                    <span class="material-icons">edit</span>
                                </button>
                                <button onclick="if(confirm('Anda yakin ingin menghapus barang ini?')) {document.getElementById('form-delete{{ $p->id }}').submit(); }" class="text-red-500 font-medium">
                                    <span class="material-icons">delete</span>
                                </button>
                                <form id="form-delete{{ $p->id }}" action="{{route('products.destroy', $p->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{--Modal Tambah--}}
        <div id="modal-tambah-item" class="fixed inset-0 bg-black bg-opacity-40 hidden item-center justify-center">
            <div class="bg-white p-6 rounded-2xl shadow-lg w-96">
                <h2 class="text-lg font-bold mb-4">Tambah Item Baru</h2>
                <form action="{{route ('products.store')}}" method="POST">
                    @csrf
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" class="w-full border p-2 mb-3 rounded" required>

                    <label for="harga">Harga</label>
                    <input type="number" name="harga" class="w-full border p-2 mb-3 rounded" required>

                    <label for="stok" class="text-sm">Stok</label>
                    <input type="number" name="stok" class="w-full border p-2 mb-3 rounded" required>

                    <label for="deskripsi" class="text-sm">deskripsi</label>
                    <textarea name="deskripsi" class="w-full border p-2 mb-3 rounded"></textarea>
                    <div class="flex justify-end gap-3 mt-2">
                        <button type="button" onclick="toggle_modal()" class="text-white-500">Batal</button>
                        <button type="submit" class="bg-green-400 text-white px-4 py-2 rounded-2xl">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        {{--Modal Edit--}}
        <div id="modal-edit-item" class="fixed inset-0 bg-black bg-opacity-40 hidden item-center justify-center">
            <div class="bg-white p-6 rounded-2xl shadow-lg w-96">
                <h2 class="text-lg font-bold mb-4">Edit Barang</h2>
                <form id="form-edit" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" id="edit_nama_barang" name="nama_barang" class="w-full border p-2 mb-3 rounded" required>

                    <label for="harga">Harga</label>
                    <input type="number" id="edit_harga" name="harga" class="w-full border p-2 mb-3 rounded" required>

                    <label for="stok" class="text-sm">Stok</label>
                    <input type="number" id="edit_stok" name="stok" class="w-full border p-2 mb-3 rounded" required>

                    <label for="deskripsi" class="text-sm">deskripsi</label>
                    <textarea id="edit_deskripsi" name="deskripsi" class="w-full border p-2 mb-3 rounded"></textarea>
                    <div class="flex justify-end gap-3 mt-2">
                        <button type="button" onclick="document.getElementById('modal-edit-item').classList.replace('flex, hidden')" class="text-white-500">Batal</button>
                        <button type="submit" class="bg-blue-400 text-white px-4 py-2 rounded-2xl">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function toggle_modal(){
                const modal = document.getElementById('modal-tambah-item');
                modal.classList.toggle('hidden');
                modal.classList.toggle('flex');
            }
            function toggle_edit(item){
                const modal = document.getElementById('modal-edit-item');

                //mengatur route pada action form dengan data item yang dipilih
                document.getElementById('form-edit').action = '/products/'+ item.id;

                //mengisi value input
                document.getElementById('edit_nama_barang').value = item.nama_barang;
                document.getElementById('edit_harga').value = item.harga;
                document.getElementById('edit_stok').value = item.stok;
                document.getElementById('edit_deskripsi').value = item.deskripsi;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

        </script>
    </body>
</html>