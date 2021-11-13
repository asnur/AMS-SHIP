@extends('layouts.layout')
@section('content')
    @php
    $no = 1;
    $no_group = 1;
    @endphp
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Inventory</h1>
            <div class="text-right">
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal"
                    data-target="#addGroupInventory"><i class="fas fa-plus fa-sm text-white-50"></i> Create Group</a>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                    data-target="#assignGroupInventory"><i class="fas fa-sign-in-alt fa-sm text-white-50"></i> Assign
                    Group</a>
            </div>
            {{-- <input type="datetime-local"> --}}
        </div>

        <div class="modal fade" id="previewInventory" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">List Inventory</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body listInventory">

                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('edit-inventory') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal fade" id="editInventory" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Edit Inventory</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body editListInventory">

                        </div>
                        <div class="modal-footer bg-primary">
                            <button type="submit" class="btn btn-md btn-success"><i class="fa fa-paper-plane"></i>
                                Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="{{ route('assign-inventory') }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="modal fade" id="assignGroupInventory" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Assign Group Inventory</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @livewire('group')
                        </div>
                        <div class="modal-footer bg-primary">
                            <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="{{ route('add-group-inventory') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal fade" id="addGroupInventory" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Create Group Inventory</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label class="font-weight-bold">Name Group</label>
                            <input class="form-control" name="name" placeholder="Input Name Group Inventory">
                        </div>
                        <div class="modal-footer bg-primary">
                            <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="{{ route('edit-group-inventory') }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="modal fade" id="editGroupInventory" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Group Inventory</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label class="font-weight-bold">Name Group</label>
                            <input type="hidden" class="form-control" name="id" id="id">
                            <input class="form-control" name="name" id="name" placeholder="Input Name Group Inventory">
                        </div>
                        <div class="modal-footer bg-primary">
                            <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- @livewire('task-job'); --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link font-weight-bold text-primary active" id="nav-home-tab"
                                    data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home"
                                    aria-selected="true">Inventory</a>
                                <a class="nav-item nav-link font-weight-bold text-primary" id="nav-profile-tab"
                                    data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                                    aria-selected="false">Group</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <br>
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Group</th>
                                            <th colspan="4" style="text-align:center">Inventory</th>
                                            <th rowspan="2">Action</th>
                                        </tr>
                                        <tr>
                                            <th>Installed</th>
                                            <th>Used</th>
                                            <th>Reserved</th>
                                            <th>Ready Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inventory_group as $ig)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $ig->name }}</td>
                                                <td>{{ stock($ig->id, 'installed') }}</td>
                                                <td>{{ stock($ig->id, 'used') }}</td>
                                                <td>{{ stock($ig->id, 'reserved') }}</td>
                                                <td>{{ stock($ig->id, 'ready') }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-success"
                                                        onclick="previewItem({{ $ig->id }})"
                                                        data-target="#previewInventory" data-toggle="modal"><i
                                                            class="fa fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-primary"
                                                        onclick="editInventory({{ $ig->id }})"
                                                        data-target="#editInventory" data-toggle="modal"><i
                                                            class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Group</th>
                                            <th colspan="4" style="text-align:center">Inventory</th>
                                            <th rowspan="2">Action</th>
                                        </tr>
                                        <tr>
                                            <th>Installed</th>
                                            <th>Used</th>
                                            <th>Reserved</th>
                                            <th>Ready Stock</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table table-striped" id="table-group">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($inventory_group as $ig)
                                            <tr>
                                                <td>{{ $no_group++ }}</td>
                                                <td>{{ $ig->name }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        onclick="editInventoryGroup({{ $ig->id }}, '{{ $ig->name }}')"
                                                        data-target="#editGroupInventory" data-toggle="modal"><i
                                                            class="fa fa-edit"></i></a>
                                                    <form class="d-inline"
                                                        action="{{ route('delete-group-inventory') }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $ig->id }}">
                                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
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
