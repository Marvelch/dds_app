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

    <form action="{{URL('/users/post_all_oppenent')}}" method="post">
        @csrf

        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-10 col-md-10 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="table table-responsive">
                                    @foreach ($kasMsk as $item)
                                    <table class="table-borderless">
                                        <tbody>
                                            <tr>
                                                <td style="width: 9rem;">Kas Masuk</td>
                                                <td>: {{$item->kasmsk}}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td>: {{$item->tgl}}</td>
                                            </tr>
                                            <tr>
                                                <td>No Bukti</td>
                                                <td>: {{$item->nobukti}}</td>
                                            </tr>
                                            <tr>
                                                <td>Penerima</td>
                                                <td>: {{$item->subket}}</td>
                                            </tr>
                                            <tr>
                                                <td>Keterangan</td>
                                                <td>: {{$item->ket}}</td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div id="example_wrapper" class="dataTables_wrapper">
                            <table id="example" class="display dataTable" style="width:100%"
                                aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Name: activate to sort column descending" style="width: 94px;">
                                            Kas Masuk
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Office: activate to sort column ascending"
                                            style="width: 96.7396px;">No.
                                            Baris
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Office: activate to sort column ascending"
                                            style="width: 96.7396px;">
                                            Lawan
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Office: activate to sort column ascending"
                                            style="width: 96.7396px;">
                                            Ref
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Office: activate to sort column ascending"
                                            style="width: 96.7396px;">
                                            Mata Uang
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Office: activate to sort column ascending"
                                            style="width: 96.7396px;">
                                            Jumlah
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Office: activate to sort column ascending"
                                            style="width: 96.7396px;">
                                            Keterangan
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

            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div id="example_wrapper" class="dataTables_wrapper">
                            <table id="example_cekmasuk" class="display dataTable" style="width:100%"
                                aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Name: activate to sort column descending" style="width: auto;">
                                            Kas Masuk
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Position: activate to sort column ascending"
                                            style="width: autopx;">
                                            No Baris</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Office: activate to sort column ascending" style="width: auto;">
                                            Kas
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Start date: activate to sort column ascending"
                                            style="width: auto;">
                                            Giro</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Start date: activate to sort column ascending"
                                            style="width: auto;">
                                            Tanggal Cair</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Start date: activate to sort column ascending"
                                            style="width: auto;">
                                            Mata Uang
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Start date: activate to sort column ascending"
                                            style="width: auto;">
                                            Nilai
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Start date: activate to sort column ascending"
                                            style="width: auto;">
                                            Keterangan
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

            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <a href="{{URL('/users/cash_list')}}"
                        class="btn btn-danger btn-sm shadow-sm col-md-1 text-white-30">Kembali</a>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scriptjs')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#example').DataTable({
            "searching": false,
            "lengthChange": false,
            paging: false,
            ordering: false,
            info: false,
            processing: true,
            serverSide: true,
            ajax: "{{ url('/users/info/cash_in/first', [Request::segment(4)]) }}",
            columns: [{
                    data: 'kasmsk',
                },
                {
                    data: 'baris',
                },
                 {
                    data: 'gollawan',
                },
                {
                    data: 'ref'
                },
                {
                    data: 'cur'
                },
                {
                    data: 'nil'
                },
                {
                    data: 'ket'
                }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Pencarian",
                "zeroRecords": "Data Kosong !",
                "info": "Tampilkan _PAGE_ dari _PAGES_"
            }
        });


        $('#example_cekmasuk').DataTable({
            "searching": false,
            "lengthChange": false,
            paging: false,
            ordering: false,
            info: false,
            processing: true,
            serverSide: true,
            ajax: "{{ url('/users/info/cash_in/second', [Request::segment(4)]) }}",
            columns: [{
                    data: 'kasmsk',
                },
                {
                    data: 'baris',
                },
                {
                    data: 'kas',
                },
                {
                    data: 'giro'
                },
                {
                    data: 'tglcair'
                },
                {
                    data: 'cur'
                },
                {
                    data: 'nil'
                },
                {
                    data: 'ket'
                }
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
@endpush

@endsection