<x-html-layout>
    <x-slot:title>
        Ubah Buku | e-book
        </x-slot>
        <x-sidebar-layout></x-sidebar-layout>
        <div id="main" class="pt-xl-0 pt-sm-3 mt-0 ml-1 px-4">
            <div class="row">
                <div class="col-6">
                    <div class="m-0 pt-2 ">
                        <h3 class="m-0 p-0 text-white">Ubah Buku</h3>
                        <p class="text-white-50">Form perubahan Buku</p>
                    </div>
                </div>

                <div class="col-6 mt-3">
                    <nav class="breadcrumb-header float-md-end" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-white-50">Manajemen</li>
                            <li class="breadcrumb-item"><a href="stock" style="color: #d9d9d9">Kategori</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="add-item">Ubah Buku</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <section class="section">
                <form action="{{ route('update-book', ['id' => $editBuku->id]) }}" method="POST">
                    <div style="border-bottom: 2px solid; border-radius: 4px;" class="card border-primary">
                        <div class="card-body">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <div class="row">
                                @csrf
                                <div class="row p-0 m-0">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="nameLead">Nama Buku</label>
                                            <input type="text" name="title" class="form-control"
                                                placeholder="Nama*" value="{{ $editBuku->title }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="nameLead">Penulis Buku</label>
                                            <input type="text" name="writer" class="form-control"
                                                placeholder="Penulis*" value="{{ $editBuku->writer }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nameLead">Kode Buku</label>
                                    <input type="text" name="code" class="form-control" placeholder="Kode"
                                        value="{{ $editBuku->code }}">
                                </div>
                                <div class="row p-0 m-0">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="nameLead">Harga Buku</label>
                                            <input type="number" name="price" class="form-control"
                                                placeholder="10000" value="{{ $editBuku->price }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="nameLead">Stok Buku</label>
                                            <input type="number" name="stock" class="form-control" value="{{ $editBuku->stock }}"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-2 d-flex justify-content-end">
                                    <button class="btn btn-primary w-auto" type="submit">Ubah Buku</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <x-html-script-layout></x-html-script-layout>
</x-html-layout>
