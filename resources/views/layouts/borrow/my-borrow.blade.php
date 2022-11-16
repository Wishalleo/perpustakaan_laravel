<x-html-layout>
    <x-slot:title>
        Pinjam | e-book
        </x-slot>
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
                                                        <input type="text" name="code" id="code"
                                                            class="form-control" autofocus>
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
                                                <a href="{{ route('delete-cart', ['id' => $isi->id]) }}"
                                                    class="btn btn-danger block ms-1">
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
                                                            class="form-control" value="{{ $kodePeminjam->code_user }}"
                                                            hidden>
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
                                                    <input type="text" value="" name="title"
                                                        id="title" class="form-control" required
                                                        onkeypress="return false;">
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
        <x-html-script-layout>
            <script>
                let jquery_datatable = $("#table").DataTable();
                @if (Session::has('message'))
                    {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Kode Tidak Ditemukan',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                @elseif (Session::has('user')) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Isi Kode Anggota Terlebih Dahulu',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                @elseif (Session::has('use')) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Buku masih digunakan',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                @endif
            </script>
        </x-html-script-layout>
</x-html-layout>
