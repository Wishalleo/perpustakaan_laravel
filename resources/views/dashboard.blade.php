<x-html-layout>
    <x-slot:title>
        Dashboard | e-book
        </x-slot>
        <x-sidebar-with-profile-layout></x-sidebar-with-profile-layout>
        <div id="main" class="pt-5 pt-xl-0 pt-lg-5 pt-md-5 pt-sm-5 px-3">
            <div class="text-white h4">Selamat Datang di IraTani App, {{ Auth::user()->name }}</div>
            <section class="row">
                <div class="col-12 col-lg-4">
                    <div class="py-2 my-0">
                        <div style="margin-top: -15px" class="col-12 col-lg-12 col-md-12">
                            <div style="border-radius: 4px;" class="card my-3 ">
                                <div class="card-body px-4 ">
                                    <div class="row">
                                        <div style="top: -10px; position: absolute; box-shadow: 0 4px 10px rgba(0, 0, 0, .1); padding: 10px 15px; border-radius: 10px;"
                                            class=" col-2 col-sm-6 col-md-8 col-lg-5 card"></div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Total Buku Hari Ini</h6>
                                            {{-- <h6 class="font-extrabold mb-0">@currency($totalLaba)</h6> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12 col-md-12">
                            <div style=" border-radius: 4px;" class="card my-3 ">
                                <div class="card-body px-4 ">
                                    <div class="row">
                                        <div style="top: -10px; position: absolute; box-shadow: 0 4px 10px rgba(0, 0, 0, .1); padding: 10px 15px; border-radius: 10px;"
                                            class=" col-2 col-sm-6 col-md-8 col-lg-5 card"></div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Total Buku Yang Dipinjam</h6>
                                            {{-- <h6 class="font-extrabold mb-0">{{ $totalTransaksi }}</h6> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card ">
                            <div class="card-header">
                                <h4>Statistik Kategori</h4>
                            </div>
                            <div class="card-body col-lg-12">
                                <div id="chart-visitors-profile" class="col-lg-8 mx-auto"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="border-radius: 5px; height: min-content" class="card col-lg-8 mt-4">
                    <div style="top: -25px; position: absolute; width: auto; box-shadow: 0 4px 10px rgba(0, 0, 0, .1); padding: 10px 15px; border-radius: 10px;"
                        class="card-header">
                        <h5 class="mb-0">Buku Yang Sering Dipinjam</h5>
                    </div>
                    <div class="card-body pt-4 mt-0">
                        <div class="table-responsive">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Buku</th>
                                        <th>Harga</th>
                                        <th class="text-center">Jumlah Peminjam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($populer as $populer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $populer->name }}</td>                                        
                                        <td>{{ $populer->sell_price }}</td>
                                        <td class="text-center">{{ $populer->total }}</td>                                        
                                    </tr>
                                @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <x-html-script-layout></x-html-script-layout>
</x-html-layout>
