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
                                                {{-- <td>
                                                <form action="" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $data->code_borrow }}"
                                                        name="code_borrow">
                                                    <button type="submit" class="btn btn-danger btn-sm mx-auto d-block">
                                                        <i class="bi bi-printer"></i>
                                                    </button>
                                                </form>
                                                <a href="" class="btn btn-info btn-sm">
                                                    <i class="bi bi-patch-question"></i>
                                                </a>
                                            </td> --}}
                                                <td class="text-center">
                                                    <a href="{{ route('check-forfeit', ['code' => $data->code]) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="bi bi-cash"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-printer"></i>
                                                    </a>
                                                </td>
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
                @if (Session::has('done'))
                    {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-primary',
                                cancelButton: 'btn btn-danger ms-2'
                            },
                            buttonsStyling: false
                        })
                        swalWithBootstrapButtons.fire({
                            title: '<strong>Peminjam Yang Disiplin</strong>',
                            icon: 'info',
                            html: 'Apakah kamu ingin menyelesaikan pinjaman ini?',
                            showCloseButton: true,
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonText: '<a href="//sweetalert2.github.io" class="text-white"><i class="bi bi-hand-thumbs-up-fill"></i> Selesaikan</a>',
                            confirmButtonAriaLabel: 'Thumbs up, great!',
                            cancelButtonText: '<i class="bi bi-hand-thumbs-down-fill"></i>',
                            cancelButtonAriaLabel: 'Thumbs down'
                        })
                    }
                @endif
            </script>
        </x-html-script-layout>
</x-html-layout>
