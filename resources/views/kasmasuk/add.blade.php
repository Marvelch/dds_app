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
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{URL('/users/post_all_oppenent')}}" method="post">
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
                                                value="{{ date('Y-m-d', strtotime(" +0 day")) }}">
                                            @error('dateToday')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">No Bukti</label>
                                        <input type="text" id="" name="unique_code" class="form-control"
                                            value="{{$uniqueCode}}" readonly>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="">Terima Dari</label>
                                        <input type="text" name="accepted" class="form-control"
                                            value="{{old('accepted')}}">
                                        @error('accepted')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Keterangan</label>
                                        <textarea name="description" id="" cols="30" rows="4" class="form-control"
                                            value="{{old('description')}}"></textarea>
                                        @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
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
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-add-modal-lg"><i
                                class="fas fa-plus fa-sm text-white-50"></i>
                            Tambah</a>
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
                                            Lawan
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Position: activate to sort column ascending"
                                            style="width: 124.385px;">
                                            Nama Lawan</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Office: activate to sort column ascending"
                                            style="width: 96.7396px;">No.
                                            Ref
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Extn.: activate to sort column ascending"
                                            style="width: 87.0729px;">
                                            Cur</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Start date: activate to sort column ascending"
                                            style="width: 141px;">
                                            Nilai</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Start date: activate to sort column ascending"
                                            style="width: 141px;">
                                            Keterangan</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Start date: activate to sort column ascending"
                                            style="width: 141px;">
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
                        {{-- <h6 class="m-0 font-weight-bold text-primary">Title 2</h6> --}}
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-add2-modal-lg"><i
                                class="fas fa-plus fa-sm text-white-50"></i>
                            Tambah</a>
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
                                            Kas Bank
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Position: activate to sort column ascending"
                                            style="width: autopx;">
                                            Tanggal Cair</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Office: activate to sort column ascending" style="width: auto;">
                                            Mata Uang
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            aria-label="Start date: activate to sort column ascending"
                                            style="width: auto;">
                                            Nilai</th>
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

            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-danger btn-sm m-1" href="{{URL('/users/cash_list')}}">Batal</a>
                    <button type="submit" class="btn btn-primary btn-sm m-1">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    {{-- Modal Detail 1 --}}
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
                    <form action="{{URL('users/submit_detail_opponent')}}" method="post">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">No Ref</label>
                                    <input name="no_ref" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Pilih Currency</label>
                                    <select name="currency" id="" class="form-control">
                                        <option value="IDR">IDR</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
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

    {{-- Modal Detail 2--}}
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
                    <form action="{{URL('users/post_cek_masuk')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kas / Bank</label>
                                    <select name="cash_bank" class="form-control" value="{{old('cash_bank')}}">
                                        @foreach ($cash as $item)
                                        <option value="{{$item->kas}}">{{$item->kas}}</option>
                                        @endforeach
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tanggal Pencairan</label>
                                    <input type="date" name="liquid_date" id="" class="form-control"
                                        value="{{ date('Y-m-d', strtotime(" +0 day")) }}"
                                        value="{{old('liquid_date')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Pilih Currency</label>
                                    <select name="currency" id="" class="form-control" value="{{old('currency')}}">
                                        <option value="IDR">IDR</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
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

</script>
@endpush

<script>
    // Datatables
    document.addEventListener('DOMContentLoaded', function () {
        $('#example').DataTable({
            "searching": false,
            "lengthChange": false,
            paging: false,
            ordering: false,
            info: false,
            processing: true,
            serverSide: true,
            ajax: "{{ url('/users/get_kas_masuk_opponent/') }}",
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
                }
            ]
        });

        $('#example_cekmasuk').DataTable({
            "searching": false,
            "lengthChange": false,
            paging: false,
            ordering: false,
            info: false,
            processing: true,
            serverSide: true,
            ajax: "{{ url('/users/get_cek_masuk/') }}",
            columns: [{
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
            ]
        });
    });

</script>

@endsection