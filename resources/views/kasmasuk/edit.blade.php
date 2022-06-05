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

    <form action="{{URL('/users/general_edit_cash_in/'.$kasmskTable->id.'/'.$kasmskTable->kasmsk)}}" method="post">
        @method('PUT')
        @csrf

        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-10 col-md-10 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="row small">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="">Tanggal</label>
                                            <input type="date" name="dateToday" id="" class="form-control"
                                                value="{{ date('Y-m-d', strtotime($kasmskTable->tgl)) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">No Bukti</label>
                                        <input type="text" id="" name="unique_code" class="form-control"
                                            value="{{$kasmskTable->nobukti}}" readonly>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="">Terima Dari</label>
                                        <input type="text" name="accepted" class="form-control"
                                            value="{{$kasmskTable->subket}}">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Keterangan</label>
                                        <textarea name="description" id="" cols="30" rows="4"
                                            class="form-control">{{$kasmskTable->ket}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
                        {{-- <h6 class="m-0 font-weight-bold text-primary">Title 1</h6> --}}
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-add-modal-lg"><i
                                class="fas fa-plus fa-sm text-white-50"></i>
                            Tambah</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div id="example_wrapper" class="dataTables_wrapper">
                            <div class="shadow pb-4">
                                <table id="example" class="display dataTable" style="width:100%"
                                    aria-describedby="example_info">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">
                                                Kas Masuk
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending">
                                                Baris</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 96.7396px;">
                                                Gol Lawan
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Extn.: activate to sort column ascending"
                                                style="width: 87.0729px;">
                                                Lawan</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 141px;">
                                                Ref</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 141px;">
                                                Mata Uang</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 141px;">
                                                Nilai
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 141px;">
                                                Keterangan
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending">

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
                            <div class="font-italic p-1 small">
                                <span>Pembaharuan Data Tersedia Dibawah :</span>
                            </div>
                            <div class="shadow">
                                <table id="example_kasmsk" class="display dataTable" style="width:100%"
                                    aria-describedby="example_info">
                                    <thead>
                                        <tr>
                                            <th>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
                                            </th>
                                            <th>

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

            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
                        {{-- <h6 class="m-0 font-weight-bold text-primary">Title 2</h6> --}}
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-add2-modal-lg"><i
                                class="fas fa-plus fa-sm text-white-50"></i>
                            Tambah</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div id="example_wrapper" class="dataTables_wrapper">
                            <div class="shadow pb-4">
                                <table id="example_cekmasuk" class="display dataTable" style="width:100%"
                                    aria-describedby="example_info">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: auto;">
                                                Kas Bank
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: autopx;">
                                                Baris</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: autopx;">
                                                Kas / Bank</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: auto;">
                                                Giro
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: auto;">
                                                Tanggal Cair</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: auto;">
                                                Mata Uang</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: auto;">
                                                Nilai
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: auto;">
                                                Keterangan
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending">

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
                            <div class="font-italic p-1 small">
                                <span>Pembaharuan Data Tersedia Dibawah :</span>
                            </div>
                            <div class="shadow">
                                <table id="example_cekmsk" class="display dataTable" style="width:100%"
                                    aria-describedby="example_info">
                                    <thead>
                                        <tr>
                                            <th>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
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

            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-danger btn-sm m-1">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm m-1">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    {{-- Modal --}}
    <div class="modal fade bd-add-modal-lg small" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{URL('users/submit_detail_opponent/edit/'.$kasmskTable->kasmsk)}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Pilih Lawan</label>
                                    <select name="opponent" id="opponent" class="form-control">
                                        @foreach ($oppenents as $item)
                                        <option value="{{$item->oppenent_name}}" selected>{{$item->oppenent_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Pilih Nama Lawan</label>
                                    <select name="push_opponent" id="push_opponent" class="form-control">
                                        <option value=""></option>
                                    </select>
                                    <input type="hidden" name="push_opponent_hidden" id="push_opponent_hidden">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">No Ref</label>
                                    <input name="no_ref" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Pilih Currency</label>
                                    <select name="currency" id="" class="form-control">
                                        <option value="IDR">IDR</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nilai</label>
                                    <input name="value" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Keterangan</label>
                                <textarea name="description" id="" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Title 2--}}
    <div class="modal fade bd-add2-modal-lg small" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{URL('users/submit/edit/cek_masuk/'.$kasmskTable->kasmsk)}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kas / Bank</label>
                                    <select name="cash_bank" class="form-control" value="{{old('cash_bank')}}">
                                        <option value="BCA">BCA</option>
                                        <option value="BRI">BRI</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">No. Giro</label>
                                    <input name="giro_number" type="text" class="form-control"
                                        value="{{old('giro_number')}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Tanggal Pencairan</label>
                                    <input type="date" name="liquid_date" id="" class="form-control"
                                        value="{{ date('Y-m-d', strtotime(" +0 day")) }}"
                                        value="{{old('liquid_date')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Pilih Currency</label>
                                    <select name="currency" id="" class="form-control" value="{{old('currency')}}">
                                        <option value="IDR">IDR</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nilai</label>
                                    <input name="value" type="text" class="form-control" value="{{old('value')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Keterangan</label>
                                <textarea name="description" id="" cols="30" rows="4" class="form-control"
                                    value="{{old('Keterangan')}}"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scriptjs')

<script>
    $('document').ready(function () {
        $('#opponent').on('change', function () {
            let valOpponent = $('#opponent').val();

            // Get data from database
            $.ajax({
                url: '/users/get_opponent/' + valOpponent,
                type: 'get',
                datatype: 'json',
                success: function (e) {
                    if (e) {
                        $('#push_opponent').empty();
                        $('#push_opponent').append('<option hidden></option>');
                        $.each(e, function (key, items) {
                            $('select[name="push_opponent"]').append(
                                '<option value="' +
                                items.id + '">' + items.nama + '</option>');
                        });
                    } else {
                        $('#push_opponent').empty();
                    }
                },
                error: function () {
                    $('#push_opponent').empty();
                    $('#push_opponent').append('<option hidden>Kosong !</option>');
                }
            });
        });

        $('#push_opponent').on('change', function () {
            let valpush_opponent = $('#push_opponent option:selected').text();
            $('#push_opponent_hidden').val(valpush_opponent);
        });
    });

    // script for delete item 
    $(document).on('click', '.delete_first', function () {
        let id = $(this).attr('data-id');
        let urlPath = window.location.pathname.split("/")[3];

        $.ajax({
            url: '/users/cash_in/first/delete/' + id,
            type: 'DELETE',
            datatype: 'json',
            data: {
                "id": id,
                "urlPath": urlPath,
                "_token": "{{ csrf_token() }}",
            },
            success: function (e) {
                if (e.redirect_url) {
                    window.location = e.redirect_url;
                }
            },
            error: function (n) {
                console.log(n);
            }
        });
    });

</script>
@endpush

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
            ajax: "{{ url('/users/info/cash_in/edit/first', [Request::segment(3)]) }}",
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
                    data: 'lawan',
                },
                {
                    data: 'ref'
                },
                {
                    data: 'cur'
                },
                {
                    data: 'nil', render: $.fn.dataTable.render.number( ',', '.', 2, ) 
                },
                {
                    data: 'ket'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
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
            ajax: "{{ url('/users/info/cash_in/edit/second', [Request::segment(3)]) }}",
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
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Pencarian",
                "zeroRecords": "Data Kosong !",
                "info": "Tampilkan _PAGE_ dari _PAGES_"
            }
        });

        $('#example_kasmsk').DataTable({
            searching: false,
            lengthChange: false,
            paging: false,
            ordering: false,
            info: false,
            processing: true,
            serverSide: true,
            ajax: "{{ url('/users/edit/get_temp_edit_kasmsk/')}}",
            columns: [{
                    data: 'table_name',
                },
                {
                    data: 'name_opponent',
                },
                {
                    data: 'no_ref',
                },
                {
                    data: 'currency',
                },
                {
                    data: 'value',
                },
                {
                    data: 'description',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Pencarian",
                "zeroRecords": "Data Kosong !",
                "info": "Tampilkan _PAGE_ dari _PAGES_"
            }
        });

        $('#example_cekmsk').DataTable({
            searching: false,
            lengthChange: false,
            paging: false,
            ordering: false,
            info: false,
            processing: true,
            serverSide: true,
            ajax: "{{ url('/users/edit/get_temp_edit_cekmsk/')}}",
            columns: [
                {
                    data: 'cash_bank',
                },
                {
                    data: 'liquid_date',
                },
                {
                    data: 'currency',
                },
                {
                    data: 'value',
                },
                {
                    data: 'description',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
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
@endsection