@extends('tamplate.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-end mb-4">
        <span class="d-flex justify-content-end">
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm m-2"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Export</a>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm m-2"><i
                    class="fas fa-download fa-sm text-white-50"></i> Print</a>
        </span>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
                    {{-- <h6 class="m-0 font-weight-bold text-primary">Laporan Lengkap</h6> --}}
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Pengelolaan:</div>
                            @if (Auth::user()->level == '1' || Auth::user()->level == '2' || Auth::user()->level == '3')
                            <a class="dropdown-item" href="{{URL('/users/add_cash_in')}}">Tambah Penerimaan</a>
                            @elseif(Auth::user()->level == '1' || Auth::user()->level == '2')

                            @elseif(Auth::user()->level == '1')

                            @else

                            @endif

                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="example_wrapper" class="dataTables_wrapper">
                        <div class="table table-responsive">
                            <table id="example" class="display dataTable" style="width: 100%;"
                                aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Name: activate to sort column descending" style="width: auto;">
                                            Kas
                                            Masuk
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Position: activate to sort column ascending"
                                            style="width: auto;">
                                            Tanggal</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Office: activate to sort column ascending" style="width: auto;">
                                            No
                                            Bukti</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Extn.: activate to sort column ascending" style="width: auto;">
                                            Terima Dari</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Start date: activate to sort column ascending"
                                            style="width: auto;">
                                            Keterangan</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Start date: activate to sort column ascending"
                                            style="width: auto;">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd">
                                        <td valign="top" colspan="6" class="dataTables_empty">Loading...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penghapusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <title>Konfirmasi Penghapusan</title>
                <br>
                <p>Konfirmasi penghapusan data secara permanen oleh pengguna. Data terhapus tidak bisa dikembalikan lagi
                    !</p>
                <input type="hidden" name="" id="temprorery_delete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" onclick="delMasmsk()">Konfirmasi</a>
            </div>
        </div>
    </div>
</div>
@push('scriptjs')
<script>
    $(document).on('click', '.delete', function () {
        let id = $(this).attr('data-id');

        $('#temprorery_delete').val(id);
    });

    function delMasmsk() {
        let temp_id = $('#temprorery_delete').val();

        $.ajax({
            url: '/users/cash_in/delete/' + temp_id,
            type: 'DELETE',
            data: {
                "id" : temp_id,
                "_token": "{{ csrf_token() }}",
            },
            success: function (e) {
                // console.log(e);
                if (e.redirect_url) {
                    window.location = e.redirect_url; 
                }
            },
            error: function(n) {
                console.log(n);
            }
        });
    }

</script>
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/users/get_cash/') }}",
            columns: [{
                    data: 'kasmsk',
                },
                {
                    data: 'tgl',
                },
                {
                    data: 'nobukti',
                },
                {
                    data: 'subket',
                },
                {
                    data: 'ket',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                },
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Pencarian",
                "zeroRecords": "Data Kosong !",
                "info": "Tampilkan _PAGE_ dari _PAGES_"
            }
        });
    });

</script>
{{-- Jquery --}}
{{--
<link href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet"> --}}

{{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}

{{-- <script src="//cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script> --}}
{{-- <script>
    $(document).ready(function () {
        $('#laravel_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/users/get_cash/') }}",
columns: [{
data: 'kasmsk',
name: 'kasmsk'
},
{
data: 'tgl',
name: 'tgl'
},
{
data: 'nobukti',
name: 'nobukti'
},
{
data: 'subket',
name: 'subket'
},
{
data: 'ket',
name: 'ket'
},
{
data: 'action',
name: 'action',
orderable: false,
searchable: false
}
]
});
});

</script> --}}
@endsection