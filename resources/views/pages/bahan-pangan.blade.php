@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Bahan Pangan'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h6>Bahan Pangan</h6>
                            </div>
                            <div class="col-md-12">
                                <a href="#" class="btn btn-sm btn-success mr-2" id="tambah-bahan" data-bs-toggle="modal"
                                    data-bs-target="#tambahBahan"><i class="fa fa-plus"></i> Tambah Data</a>

                                <a href="#" class="btn btn-sm btn-success" id="import-bahan" data-bs-toggle="modal"
                                    data-bs-target="#importBahan"><i class="fa fa-file-excel"></i> Import Data</a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped yajra-datatable" id="pangan-table">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama Bahan Pangan</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama Kategori</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Bulan</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tahun</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Harga</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Import --}}
        <div class="modal fade" id="importBahan" tabindex="-1" aria-labelledby="importBahanLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('bahan-import') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="importBahanLabel">Import Bahan Pangan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <input type="file" class="form-control" name="xlsx_file_bahan" id="xlsx_file_bahan"
                                        accept=".xlsx">
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-sm btn-primary" id="download_file_sample">Download
                                        Format</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Tambah-->
        <div class="modal fade" id="tambahBahan" tabindex="-1" aria-labelledby="tambahBahanLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahBahanLabel">Tambah Bahan Pangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('bahan-save') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_bahan" class="form-label">Nama Bahan</label><br>
                                <input type="text" class="form-control" id="nama_bahan" name="nama_bahan"
                                    placeholder="Masukkan Nama Bahan">
                            </div>
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori</label><br>
                                <select class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id"
                                    id="kategori_id">
                                    <option selected>Pilih Kategori</option>
                                    @foreach ($kategori as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bulan" class="form-label">Bulan</label><br>
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulan"
                                    id="bulan">
                                    <option selected>Pilih Bulan</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                @error('bulan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label><br>
                                <input type="text" class="form-control" id="tahun" name="tahun"
                                    placeholder="Masukkan Tahun">
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label><br>
                                <input type="text" class="form-control" id="harga" name="harga"
                                    placeholder="Masukkan Harga">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $('#download_file_sample').on('click', (e) => {
            e.preventDefault();
            window.location.href = "/download-sample";
        });
        $(function() {
            var table = $('#pangan-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json"
                },
                ajax: '{!! route('bahan-pangan') !!}', // memanggil route yang menampilkan data json
                columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        sClass: 'text-center'
                    },
                    {
                        data: 'nama_bahan',
                        name: 'nama_bahan',
                        sClass: 'text-center'
                    },
                    {
                        data: 'kategori.nama_kategori',
                        name: 'kategori.nama_kategori',
                        searchable: true,
                        sClass: 'text-center'
                    },
                    {
                        data: 'bulan',
                        searchable: false,
                        sClass: 'text-center'
                    },
                    {
                        data: 'tahun',
                        name: 'tahun',
                        searchable: false,
                        sClass: 'text-center'
                    },
                    {
                        data: 'harga',
                        name: 'harga',
                        searchable: false,
                        sClass: 'text-center',
                        render: $.fn.dataTable.render.number('.', '.', 0, 'Rp ')
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: false,
                        sClass: 'text-center'
                    }
                ],
            });
        });

        //mendapatkan data untuk update
        $('.modelClose').on('click', function() {
            $('#editKategori').hide();
        });
        var id;
        $('body').on('click', '#getEditKategoriData', function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            id = $(this).data('id');
            $.ajax({
                url: "kategori/edit/" + id + "",
                method: 'GET',
                // data: {
                //     id: id,
                // },
                success: function(result) {
                    console.log(result);
                    $('#EditKategoriModalBody').html(result.html);
                    $('#editKategori').show();
                }
            });
        });

        $('#submitEditKategori').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "kategori/" + id,
                method: 'PUT',
                data: {
                    nama_kategori: $('#editNamaKategori').val(),
                },
                success: function(result) {
                    if (result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>' + value +
                                '</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.datatable').DataTable().ajax.reload();
                        setInterval(function() {
                            $('.alert-success').hide();
                            $('#EditProductModal').hide();
                        }, 2000);
                    }
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.hapus', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            Swal.fire({
                title: 'Apakah anda yakin menghapus data ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    document.location.href =
                        href; //kembalikan nilai true dengan redirect document ke halaman yang dituju
                }
            })
        });
    </script>
@endpush
