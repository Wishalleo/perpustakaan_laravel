<x-html-layout>
    <x-slot:title>
        Laporan | e-book
        </x-slot>
        <x-sidebar-layout></x-sidebar-layout>
        <div id="main" class="pt-xl-0 pt-sm-3 mt-0 ml-1 px-4">
            <div class="row">
                <div class="col-6 order-md-1">
                    <div class="m-0 pt-2 ">
                        <h3 class="m-0 p-0 text-white">Laporan Transaksi</h3>
                        <p class="text-white-50">Informasi transaksi yang telah dilakukan oleh pelanggan</p>
                    </div>
                </div>
                <div class="mt-3 col-6 order-md-2">
                    <nav class="breadcrumb-header float-end" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="text-white-50 breadcrumb-item active">Laporan</li>
                            <li class="breadcrumb-item"><a class="text-white" href="transaction-report">Laporan
                                    Transaksi</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div style="border-radius: 4px; border-bottom: 2px solid" class="card p-0 mt-3 border-primary">
                        <div style="position: absolute; top: -25px; left: 10px;border-radius: 5px;padding: 10px 10px; border-bottom: 2px solid;text-align: center; box-shadow: 0 0 10px rgba(0, 0, 0, .15);"
                            class="card border-primary">
                            <h6 style="margin: 0px;">Laporan Transaksi</h6>
                        </div>
                        <div class="card-body mt-2">
                            <div class="table-responsive">
                                <table class="table" id="table">
                                    <thead>
                                        <th width="5%">No</th>
                                        <th>Tanggal Pelayanan</th>
                                        <th>Nomor Struk</th>
                                        <th>Nama Peminjam</th>
                                        <th>Status</th>
                                        <th>Petugas</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th class="text-center">Aksi</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->created_at }}</td>
                                                <td>{{ $data->code }}</td>
                                                <td>{{ $data->name }}</td>
                                                @if ($data->status == 0)
                                                    <td>Dipinjam</td>
                                                @else
                                                    <td>Selesai</td>
                                                @endif
                                                <td>{{ $data->operator }}</td>
                                                <td>{{ $data->return_date }}</td>
                                                @if ($data->status == 0)
                                                    <td class="text-center">
                                                        <a href="#" class="btn btn-warning btn-sm check"
                                                            data-code="{{ $data->code }}"
                                                            data-name="{{ $data->name }}">
                                                            <i class="bi bi-cash"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-printer"></i>
                                                        </a>
                                                    </td>
                                                @else
                                                    <td class="text-center">                 
                                                        <a href="#" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-printer"></i>
                                                        </a>
                                                    </td>
                                                @endif                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-html-script-layout>
            <script>
                let jquery_datatable = $("#table").DataTable();
                $('.check').click(function() {
                    var borrow_code = $(this).attr('data-code')
                    var borrow_name = $(this).attr('data-name')
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary',
                            cancelButton: 'btn btn-secondary ms-2',
                            denyButton: 'btn btn-danger ms-2'
                        },
                        buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                        title: 'Butuh Informasi?',
                        icon: 'info',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Check Denda',
                        denyButtonText: `Lunaskan`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location = "check-forfeit/" + borrow_code;
                        } else if (result.isDenied) {
                            window.location = "done-forfeit/" + borrow_code;
                        }
                    })
                });
                @if (Session::has('discipline'))
                    {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-primary',
                            },
                            buttonsStyling: false
                        })
                        swalWithBootstrapButtons.fire({
                            title: '<strong>Tidak Telat Mengembalikan</strong>',
                            icon: 'info',
                            showCloseButton: true,
                            focusConfirm: false,
                            confirmButtonText: '<i class="bi bi-hand-thumbs-up-fill"></i> Oke</a>',
                            confirmButtonAriaLabel: 'Thumbs up, great!'
                        })
                    }
                @elseif (Session::has('late')) {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-primary',
                            },
                            buttonsStyling: false
                        })
                        swalWithBootstrapButtons.fire({
                            title: '<strong>Telat Mengembalikan</strong>',
                            icon: 'warning',
                            text: "Dia telat, dan harus membayar Rp " + {{ Session::get('forfeit') }},
                            showCloseButton: true,
                            focusConfirm: false,
                            confirmButtonText: '<i class="bi bi-hand-thumbs-up-fill"></i> Oke</a>',
                            confirmButtonAriaLabel: 'Thumbs up, great!'
                        })
                    }
                @elseif (Session::has('done')) {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-primary',
                            },
                            buttonsStyling: false
                        })
                        swalWithBootstrapButtons.fire({
                            title: '<strong>Peminjaman Terselesaikan</strong>',
                            icon: 'success',
                            showCloseButton: true,
                            focusConfirm: false,
                            confirmButtonText: '<i class="bi bi-hand-thumbs-up-fill"></i> Oke</a>',
                            confirmButtonAriaLabel: 'Thumbs up, great!'
                        })
                    }
                @endif
            </script>
        </x-html-script-layout>
</x-html-layout>
