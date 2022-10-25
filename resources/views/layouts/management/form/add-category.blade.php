<x-html-layout>
    <x-slot:title>
        Tambah Kategori | e-book
        </x-slot>
        <x-sidebar-layout></x-sidebar-layout>
        <div id="main" class="pt-xl-0 pt-sm-3 mt-0 ml-1 px-4">
            <div class="row">
                <div class="col-6">
                    <div class="m-0 pt-2 ">
                        <h3 class="m-0 p-0 text-white">Tambah Kategori</h3>
                        <p class="text-white-50">Form penambahan kategori</p>
                    </div>
                </div>

                <div class="col-6 mt-3">
                    <nav class="breadcrumb-header float-md-end" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-white-50">Manajemen</li>
                            <li class="breadcrumb-item"><a href="stock" style="color: #d9d9d9">Kategori</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="add-item">Tambah Kategori</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <section class="section">
                <form action="{{ route('add-category') }}" method="POST">
                    <div style="border-bottom: 2px solid; border-radius: 4px;" class="card border-primary">
                        <div class="card-body">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <div class="row">
                                @csrf
                                <div class="form-group">
                                    <label for="nameLead">Nama Kategori</label>
                                    <input type="text" name="name" class="form-control" id="nameLead"
                                        placeholder="Nama*" >
                                </div>

                                <div class="px-2 d-flex justify-content-end">
                                    <button class="btn btn-primary w-auto" type="submit">Tambah Kategori</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <x-html-script-layout></x-html-script-layout>
</x-html-layout>
