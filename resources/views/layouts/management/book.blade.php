<x-html-layout>
    <x-slot:title>
        Buku | e-book
        </x-slot>
        <x-sidebar-layout></x-sidebar-layout>
        <div id="main" class="pt-xl-0 pt-sm-3 mt-0 ml-1 px-4">
            <div class="row">
                <div class="col-6 order-md-1">
                    <div class="m-0 pt-2 ">
                        <h3 class="m-0 p-0 text-white">Stok Buku</h3>
                        <p class="text-white-50">Table seluruh data stok buku yang tersedia</p>
                    </div>
                </div>
                <div class="mt-3 col-6 order-md-2">
                    <nav class="breadcrumb-header float-end" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="text-white-50 breadcrumb-item active">Manajemen</li>
                            <li class="breadcrumb-item"><a class="text-white" href="stock">Stok Buku</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div style="border-radius: 4px; border-bottom: 2px solid" class="card p-0 mt-3 border-primary">
                <div class="card-body mt-2">
                    <div style="position: absolute; top: -20px; left: 10px;border-radius: 5px;padding: 10px 10px; border-bottom: 2px solid;text-align: center; box-shadow: 0 0 10px rgba(0, 0, 0, .15);"
                        class="card border-0 shadow rounded">
                        <h6 style="margin: 0px;">Stok Buku</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <a href="{{ route('add-book') }}" type="button"
                                class="btn btn-success rounded-pill btn-sm float-end ms-2">
                                <i class="bi bi-plus-circle"></i>
                                <span> | Tambah Buku</span>
                            </a>
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Kode</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Dipinjam</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataBuku as $buku)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $buku->code }}</td>
                                        <td>{{ $buku->title }}</td>
                                        <td>{{ $buku->writer }}</td>
                                        <td>{{ $buku->being_borrowed }}</td>
                                        <td>{{ $buku->stock }}</td>
                                        <td>@rupiah($buku->price)</td>
                                        <td class="text-center">
                                            <a href="{{ route('update-book', ['id' => $buku->id]) }}"
                                                class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm delete"
                                                data-id="{{ $buku->id }}" data-name="{{ $buku->title }}"><i
                                                    class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <x-html-script-layout>
            <script>
                let jquery_datatable = $("#table").DataTable();
                $('.delete').click(function() {
                    var book_id = $(this).attr('data-id')
                    var book_name = $(this).attr('data-name')
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success ms-2',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                        title: 'Yakin?',
                        html: "Kamu akan kehilangan <strong>DATA BUKU</strong> yang bernama " +
                            book_name + "",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Iya, Saya Yakin!',
                        cancelButtonText: 'Tidak, Batalkan!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "delete-book/" + book_id;
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                                'Dibatalkan',
                                'Data tidak jadi dihapus :)',
                                'error'
                            )
                        }
                    })
                });

                @if (Session::has('message'))
                    {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success ms-2',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        })
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Datamu berhasil dihapus!',
                            'success'
                        )
                    }
                @endif
            </script>
        </x-html-script-layout>
</x-html-layout>
