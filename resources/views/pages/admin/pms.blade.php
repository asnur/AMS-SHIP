@extends('layouts.layout')
@section('content')
    @php
    $no = 1;
    @endphp

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">PMS</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50" data-toggle="modal" data-target="#add"></i> Create New
                TaskJob</a> --}}
            {{-- <input type="datetime-local"> --}}
        </div>

        <form action="{{ route('assign-pms') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal fade" id="prosesPMS" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header text-white bg-primary">
                            <h5 class="modal-title" id="staticBackdropLabel">Proses PMS <span id="name-pms"></span></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_taskjob" id="id-pms">
                            <label class="font-weight-bold">Image 1 (Optional)</label>
                            <div class="custom-file">
                                <input type="file" name="image_1" class="custom-file-input" id="image1" accept="image/*"
                                    onchange="previewImage_1(this)">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <img src="#" id="image_1" class="mt-2"
                                style="width: 350px; height:200px; object-fit:cover;"><br>
                            <label class="font-weight-bold mt-2">Image 2
                                (Optional)</label>
                            <div class="custom-file">
                                <input type="file" name="image_2" class="custom-file-input" id="image2" accept="image/*"
                                    onchange="previewImage_2(this)">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <img src="#" id="image_2" class="mt-2"
                                style="width: 350px; height:200px; object-fit:cover;"><br>
                            <label class="font-weight-bold mt-2">Image 3 (Optional)</label>
                            <div class="custom-file">
                                <input type="file" name="image_3" class="custom-file-input" id="image3" accept="image/*"
                                    onchange="previewImage_3(this)">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <img src="#" id="image_3" class="mt-2"
                                style="width: 350px; height:200px; object-fit:cover;"><br>
                            <label class="font-weight-bold mt-2">Date Action</label>
                            <input type="date" class="form-control" name="date_action">
                            <label class="font-weight-bold mt-2">Action</label>
                            <textarea class="form-control" id="action-pms" name="action"></textarea>
                        </div>
                        <div class="modal-footer bg-primary">
                            <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i>
                                Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="modal fade" id="previewPMS" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-white bg-primary">
                        <h5 class="modal-title" id="staticBackdropLabel">Detail PMS <span id="name-pms-preview"></span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <label class="font-weight-bold">Image 1</label>
                                <img src="" alt="" id="img-1" class="w-100">
                            </div>
                            <div class="col-4">
                                <label class="font-weight-bold">Image 2</label>
                                <img src="" alt="" id="img-2" class="w-100">
                            </div>
                            <div class="col-4">
                                <label class="font-weight-bold">Image 3</label>
                                <img src="" alt="" id="img-3" class="w-100">
                            </div>
                            <div class="col-12">
                                <label class="font-weight-bold mt-2">Date Action</label>
                                <input type="date" class="form-control" id="date_action_preview" readonly>
                                <label class="font-weight-bold mt-2">Action</label>
                                <textarea class="form-control" id="action-pms-preview" name="action" disabled></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- @livewire('task-job'); --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-primary active" id="home-tab" data-toggle="tab"
                                    href="#home" role="tab" aria-controls="home" aria-selected="true">Upcoming</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-primary" id="profile-tab" data-toggle="tab"
                                    href="#profile" role="tab" aria-controls="profile" aria-selected="false">Ongoing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-primary" id="contact-tab" data-toggle="tab"
                                    href="#contact" role="tab" aria-controls="contact" aria-selected="false">Finished</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <br>
                                <div class="category-filter-upcoming">
                                    <select id="categoryFilterUpcoming" class="form-control">
                                        <option value="">All</option>
                                        <option value="No-Critical">No Critical</option>
                                        <option value="Critical !!!">Critical</option>
                                    </select>
                                </div>
                                <table class="table table-striped" id="table-listtaskjob-upcoming">
                                    <thead>
                                        <th>No</th>
                                        <th>Code Name</th>
                                        <th>Job Desk</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tfoot>
                                        <th>No</th>
                                        <th>Code Name</th>
                                        <th>Job Desk</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($upcoming as $u)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $u->code . '-' . $u->sub_group->name }}</td>
                                                <td>{!! $u->jobdesk !!}</td>
                                                <td>{!! $u->critical == 0 ? '<label class="badge badge-success p-2">No-Critical</label>' : '<label class="badge badge-danger p-2">Critical !!!</label>' !!}
                                                </td>
                                                <td>
                                                    @if ($u->assign_inventory == '')
                                                        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-cogs"
                                                                data-toggle="modal" data-target="#assignInventory"></i></a>
                                                    @else
                                                        <form action="{{ route('open-pms') }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="id" value="{{ $u->id }}">
                                                            <button class="btn btn-sm btn-success" type="submit"><i
                                                                    class="fa fa-play"></i></button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="
                                                            tab-pane fade"
                                id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <br>
                                <div class="category-filter">
                                    <select id="categoryFilterOngoing" class="form-control">
                                        <option value="">All</option>
                                        <option value="No-Critical">No Critical</option>
                                        <option value="Critical !!!">Critical</option>
                                    </select>
                                </div>
                                <table class="table table-striped" id="table-listtaskjob-ongoing">
                                    <thead>
                                        <th>No</th>
                                        <th>Code Name</th>
                                        <th>Job Desk</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tfoot>
                                        <th>No</th>
                                        <th>Code Name</th>
                                        <th>Job Desk</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($ongoing as $o)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $o->code . '-' . $o->sub_group->name }}</td>
                                                <td>{!! $o->jobdesk !!}</td>
                                                <td>{!! $o->critical == 0 ? '<label class="badge badge-success p-2">No-Critical</label>' : '<label class="badge badge-danger p-2">Critical !!!</label>' !!}
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" data-toggle="modal"
                                                        data-target="#prosesPMS"
                                                        onclick="prosesPMS({{ $o->id }}, '{{ $o->code . '-' . $o->sub_group->name }}')"><i
                                                            class="fa fa-cogs"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <br>
                                <div class="category-filter">
                                    <select id="categoryFilterFinished" class="form-control">
                                        <option value="">All</option>
                                        <option value="No-Critical">No Critical</option>
                                        <option value="Critical !!!">Critical</option>
                                    </select>
                                </div>
                                <table class="table table-striped" id="table-listtaskjob-finished">
                                    <thead>
                                        <th>No</th>
                                        <th>Code Name</th>
                                        <th>Job Desk</th>
                                        <th>Condition</th>
                                        <th>Status</th>
                                        <th>Approve</th>
                                        <th>Action</th>
                                    </thead>
                                    <tfoot>
                                        <th>No</th>
                                        <th>Code Name</th>
                                        <th>Job Desk</th>
                                        <th>Condition</th>
                                        <th>Status</th>
                                        <th>Approve</th>
                                        <th>Action</th>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($finished as $f)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $f->code . '-' . $f->sub_group->name }}</td>
                                                <td>{!! $f->jobdesk !!}</td>
                                                <td>{!! $f->critical == 0 ? '<label class="badge badge-success p-2">No-Critical</label>' : '<label class="badge badge-danger p-2">Critical !!!</label>' !!}
                                                </td>
                                                <td>
                                                    {!! $f->status_syncron == 0 ? '<label class="badge bagde-pill badge-warning p-2">Not Syncron</label>' : '<label class="badge bagde-pill badge-success p-2">Syncron</label>' !!}

                                                </td>
                                                <td>
                                                    @if ($f->status_approve == 0)
                                                        <label class="badge bagde-pill badge-warning p-2">Waiting
                                                            Approve</label>
                                                    @elseif($f->status_approve == 1)
                                                        <label class="badge bagde-pill badge-success p-2">Approve</label>
                                                    @elseif($f->status_approve == 2)
                                                        <label class="badge bagde-pill badge-danger p-2">Not Approve</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" onclick="previewPMS({{ $f->id }})"
                                                        class="btn btn-sm btn-warning text-white" data-toggle="modal"
                                                        data-target="#previewPMS"><i class="fa fa-eye"></i></a>
                                                    <a href="" class="btn btn-sm btn-success"><i
                                                            class="fa fa-sync"></i></a>
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
        </div>
    </div>
@endsection
