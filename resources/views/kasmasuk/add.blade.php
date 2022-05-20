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

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-10 col-md-10 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row">
                        <form action="{{URL('/users/cash_list')}}" method="post">
                            @csrf
                            <div class="col">
                                <div class="row small">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="">Tanggal</label>
                                            <input type="date" name="dateToday" id="" class="form-control"
                                                value="{{ date('Y-m-d', strtotime(" +0 day")) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">No Bukti</label>
                                        <input type="text" id="" class="form-control" value="{{$uniqueCode}}" readonly>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="">Terima Dari</label>
                                        <input type="text" name="accepted" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Keterangan</label>
                                        <textarea name="description" id="" cols="30" rows="4"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-12 mt-5 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary m-1 btn-sm">
                                    Simpan
                                </button>
                                <a type="reset" class="btn btn-danger m-1 btn-sm"
                                    href="{{URL('users/cash_list')}}">Batal</a>
                            </div> --}}
                        </form>
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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Title 1</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Title 1 :</div>
                            <a class="dropdown-item" data-toggle="modal" data-target=".bd-add-modal-lg">Tambah</a>
                            {{-- <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a> --}}
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Pilih Lawan</label>
                                <select name="" id="" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">No Ref</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Pilih Currency</label>
                                <select name="" id="" class="form-control">
                                    <option value="">IDR</option>
                                    <option value="">USD</option>
                                    <option value="">EUR</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nilai</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Keterangan</label>
                            <textarea name="" id="" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection