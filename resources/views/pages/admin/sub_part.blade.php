@extends('layouts.layout')
@section('content')
    <form action="/admin/updateSubPart" method="POST">
        @csrf
        <div class="modal fade bd-example-modal-lg" id="editSubPart" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h4>Edit Unit</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="font-weight-bold">Code</label>
                        <input type="text" readonly class="form-control" name="kode" id="kode_sub_part">
                        <label class="font-weight-bold mt-3">Name</label>
                        <input type="text" readonly class="form-control" name="nama" id="nama_sub_part">
                        <label class="font-weight-bold mt-3">Spesification</label>
                        <textarea type="text" class="form-control" id="spek_sub_part" name="spek"></textarea>
                        <label class="font-weight-bold mt-3">Inspection</label>
                        <textarea type="text" class="form-control" name="inspection" id="inspection_sub_part"></textarea>
                    </div>
                    <div class="modal-footer bg-primary">
                        <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sub Part - {{ $name->nama }}</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            {{-- <input type="datetime-local"> --}}
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Specification</th>
                                    <th>Inspection</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Specification</th>
                                    <th>Inspection</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($sub_part as $sb)
                                    <tr>
                                        <td>{{ $sb->kode }}</td>
                                        <td>{{ $sb->nama }}</td>
                                        <td>{{ $sb->spek }}</td>
                                        <td>{{ $sb->inspection }}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#editSubPart" onclick="editSubPart({{ $sb->kode }})"><i
                                                    class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
