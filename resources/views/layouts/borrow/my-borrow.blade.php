<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen - Stok</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">
    <style>
        .tampil-bayar {
            font-size: 4em;
            height: 100px;
        }

        @media screen and (max-width: 900px) {
            .tampil-bayar {
                font-size: 2em;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <x-sidebar-layout></x-sidebar-layout>
    <script>
        function siap() {
            document.getElementById('kode').focus()
        }
    </script>
    <div id="main" class="pt-xl-0 pt-sm-3 mt-0 ml-1 px-4">
        <div class="row">
            <div class="col-6 order-md-1">
                <div class="m-0 pt-2 ">
                    <h3 class="m-0 p-0 text-white">Kasir</h3>
                    <p class="text-white-50">Aplikasi transaksi barang</p>
                </div>
            </div>
            <div class="mt-3 col-6 order-md-2">
                <nav class="breadcrumb-header float-end" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="text-white-50 breadcrumb-item active">Dashboard</li>
                        <li class="breadcrumb-item"><a class="text-white" href="stock">Kasir</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div style="border-radius: 4px; border-bottom: 2px solid" class="card p-0 mt-3 border-primary">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9">
                                    {{-- <form action="/isiKeranjang" method="POST">
                                        <div class="input-group">
                                            @csrf
                                            <table>
                                                <input type="text" name="tgl" value="{{ date('Y/m/d') }}"
                                                    readonly class="form-control" hidden>
                                                <tr>
                                                    <td>
                                                        <label for="kode_produk">Kode Produk</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="kode" id="kode"
                                                            class="form-control" required>
                                                    </td>                                                    
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="kode_produk">Jumlah</label>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="jml"
                                                            value="1">
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-primary block ms-2">
                                                            <i class="bi bi-caret-right-square"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </form> --}}
                                    @forelse ($isi as $isi)
                                    <form action="{{ route('add-cart') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="kembali" class="col-lg-2 control-label">Kode Buku</label>
                                            <div class="col-lg-8 pe-0">
                                                <input type="text" value="{{ $isi->code }}" name="code" id="code" class="form-control"
                                                    readonly>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="submit" class="btn btn-danger block ms-1">
                                                    Hapus Judul
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="{{ route('add-borrow') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="judul" class="col-lg-2 control-label">Judul Buku</label>
                                            <div class="col-lg-10">                                                    
                                                <input type="text" value="{{ $isi->title }}" name="title"
                                                id="title" class="form-control" readonly>
                                            <input type="text" value="{{ $isi->code }}" name="code"
                                                id="code" class="form-control" hidden>                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tgl_kembali" class="col-lg-2 control-label">Tanggal
                                                Dikembalikan</label>
                                            <div class="col-lg-9">
                                                <input type="number" name="return_date" id="return_date"
                                                    class="form-control" placeholder="Angka untuk hari" autofocus>
                                            </div>
                                            <div class="col-lg-1">
                                                <button type="submit" class="btn btn-primary block ms-1">
                                                    <i class="bi bi-save"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>                                                                                
                                    @empty
                                    <form action="{{ route('add-cart') }}" method="GET">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="kembali" class="col-lg-2 control-label">Kode Buku</label>
                                            <div class="col-lg-8 pe-0">
                                                <input type="text" name="code" id="code" class="form-control"
                                                    autofocus>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="submit" class="btn btn-primary block ms-lg-4">
                                                    Cek Judul
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="{{ route('add-borrow') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="judul" class="col-lg-2 control-label">Judul Buku</label>
                                            <div class="col-lg-10">                                                
                                                <input type="text" value="" name="title" id="title"
                                                class="form-control" readonly required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tgl_kembali" class="col-lg-2 control-label">Tanggal
                                                Dikembalikan</label>
                                            <div class="col-lg-9">
                                                <input type="number" name="return_date" id="return_date"
                                                    class="form-control">
                                            </div>
                                            <div class="col-lg-1">
                                                <button type="submit" class="btn btn-primary block ms-2">
                                                    <i class="bi bi-save"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>                                        
                                    @endforelse
                                </div>
                                <div class="col-lg-3">
                                    <label class="float-end my-2">Invoice : {{ Session::get('code_borrow') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/jquery-3.5.1.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>

        <!-- Need: Apexcharts -->
        <script src="{{ asset('assets/js/apexcharts.min.js') }}"
            integrity="sha512-oUoSexkALUPd0BQaO/0m029XijXQ7XlFbPIhDNvzD8r2XhUjidiRo/8YhJGpoevLZVRwRFBvygSc9jV2TagjfQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script> -->
        <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
        <script>
            // let jquery_datatable = $("#table").DataTable({
            //     searching: true,
            //     paging: true,
            //     info: true
            // });
            let jquery_datatable = $("#table").DataTable();

            function tampilProduk() {
                $('#modal-produk').modal('show');
            }
        </script>
</body>

</html>
