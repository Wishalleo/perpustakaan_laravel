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
                    <h3 class="m-0 p-0 text-white">Pinjam</h3>
                    <p class="text-white-50">Aplikasi meminjam buku</p>
                </div>
            </div>
            <div class="mt-3 col-6 order-md-2">
                <nav class="breadcrumb-header float-end" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="text-white-50 breadcrumb-item active">Dashboard</li>
                        <li class="breadcrumb-item"><a class="text-white" href="stock">Pinjam</a></li>
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
                                    @forelse ($peminjam as $peminjam)
                                    <h5 class="my-2">Nama Peminjam : {{ $peminjam->name }}</h5>
                                    @empty
                                    <form action="{{ route('check-member') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="kembali" class="col-lg-2 control-label">Kode
                                                Anggota</label>
                                            <div class="col-lg-7 pe-0">
                                                <input type="text" name="code" id="code" class="form-control"
                                                    autofocus>
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-secondary block">
                                                    Cek Anggota
                                                </button>
                                            </div>
                                        </div>
                                    </form>                                    
                                    @endforelse
                                </div>
                                <div class="col-lg-3">
                                    <label class="float-end my-2">Invoice :
                                        {{ Session::get('code_borrow') }}</label>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-12">                            
                                @forelse ($isi as $isi)
                                    
                                        <div class="form-group row">
                                            <label for="kembali" class="col-lg-2 control-label">Kode Buku</label>
                                            <div class="col-lg-8 pe-0">
                                                <input type="text" value="{{ $isi->code }}" name="code"
                                                    id="code" class="form-control" readonly>
                                            </div>
                                            <div class="col-lg-2">
                                                <a href="{{ route('delete-cart', ['id' => $isi->id]) }}" class="btn btn-danger block ms-1">
                                                    Hapus Judul
                                                </a>
                                                {{-- <button type="submit" class="btn btn-danger block ms-1">
                                                    
                                                </button> --}}
                                            </div>
                                        </div>
                                    
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
                                                    <i class="bi bi-save"></i> Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @empty
                                    <form action="{{ route('add-cart') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="kembali" class="col-lg-2 control-label">Kode Buku</label>
                                            <div class="col-lg-8 pe-0">
                                                @forelse ($kodePeminjam as $kodePeminjam)
                                                <input type="text" name="code_user" id="code_user"
                                                    class="form-control" value="{{ $kodePeminjam->code_user }}" hidden>                                                    
                                                <input type="text" name="code" id="code"
                                                    class="form-control" autofocus required>                                                    
                                                @empty                                                    
                                                <input type="text" name="code" id="code"
                                                    class="form-control" required>
                                                @endforelse
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="submit" class="btn btn-secondary block ms-lg-4">
                                                    Cek Judul
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="{{ route('add-borrow') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="judul" class="col-lg-2 control-label">Judul
                                                Buku</label>
                                            <div class="col-lg-8 pe-0">
                                                <input type="text" value="" name="title" id="title"
                                                    class="form-control" required onkeypress="return false;">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tgl_kembali" class="col-lg-2 control-label">Tanggal
                                                Dikembalikan</label>
                                            <div class="col-lg-8 pe-0">
                                                <input type="number" name="return_date" value="7"
                                                    id="return_date" class="form-control">
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="submit" class="btn btn-primary block ms-4">
                                                    <i class="bi bi-save"></i> Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endforelse
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
