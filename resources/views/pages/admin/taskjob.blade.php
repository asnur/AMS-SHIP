@extends('layouts.layout')
@section('content')
    @php
    $no = 1;
    $no_group = 1;
    $no_list_group = 1;
    @endphp
    <form action="{{ route('add-group-taskjob') }}" method="POST">
        @csrf
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-white bg-primary">
                        <h5 class="modal-title" id="staticBackdropLabel">Create New Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="name" class="font-weight-bold">Name </label>
                        <input class="form-control" name="name" type="text" placeholder="Name">
                    </div>
                    <div class="modal-footer bg-primary">
                        <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Send</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('give-role-taskjob') }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="modal fade" id="giveRole" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-white bg-primary">
                        <h5 class="modal-title" id="staticBackdropLabel">Give Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="name" class="font-weight-bold">Name </label>
                        <input type="hidden" id="id-give-role" name="id">
                        <input class="form-control" id="name-taskjob-role" type="text" placeholder="Name" readonly>
                        <label for="name" class="font-weight-bold mt-2">Role </label>
                        <select class="form-control" name="role" id="role-taskjob">
                            @foreach ($roles as $r)
                                <option value="{{ $r->name }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer bg-primary">
                        <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Send</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('give-role-taskjob-group') }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="modal fade" id="giveRoleGroup" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-white bg-primary">
                        <h5 class="modal-title" id="staticBackdropLabel">Give Role for Group <span
                                id="name-group-give-role"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id-give-role-group" name="id">
                        <label for="name" class="font-weight-bold">Role </label>
                        <select class="form-control" name="role">
                            @foreach ($roles as $r)
                                <option value="{{ $r->name }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer bg-primary">
                        <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Send</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('edit-group-taskjob') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="editGroup" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-white bg-primary">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="name" class="font-weight-bold">Name </label>
                        <input class="form-control" name="name" id="name_group_edit" type="text" placeholder="Name">
                        <input class="form-control" name="id" id="id_group_edit" type="hidden" placeholder="Name">
                    </div>
                    <div class="modal-footer bg-primary">
                        <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Send</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('process-running-hour') }}" method="POST">
        @csrf
        <div class="modal fade" id="runningHour" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-white bg-primary">
                        <h5 class="modal-title" id="staticBackdropLabel">Process TaskJob</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="idTaskJob">
                        <label class="font-weight-bold">Name Task</label>
                        <input class="form-control" name="name" type="text" id="name_group" disabled placeholder="Name">
                        <label class="font-weight-bold mt-3">Start Hour</label>
                        <input class="form-control" name="start_hour" type="datetime-local">
                        <label class="font-weight-bold mt-3">End Hour</label>
                        <input class="form-control" name="end_hour" type="datetime-local">
                    </div>
                    <div class="modal-footer bg-primary">
                        <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Send</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('process-running-hour-group') }}" method="POST">
        @csrf
        <div class="modal fade" id="runningHourGroup" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-white bg-primary">
                        <h5 class="modal-title" id="staticBackdropLabel">Process TaskJob per Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="idTaskJobGroup">
                        <label class="font-weight-bold">Name Task</label>
                        <input class="form-control" name="name" type="text" id="name_group_grouping" disabled
                            placeholder="Name">
                        <label class="font-weight-bold mt-3">Start Hour</label>
                        <input class="form-control" name="start_hour" type="datetime-local">
                        <label class="font-weight-bold mt-3">End Hour</label>
                        <input class="form-control" name="end_hour" type="datetime-local">
                    </div>
                    <div class="modal-footer bg-primary">
                        <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Send</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="listTaskJob" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-white bg-primary">
                    <h5 class="modal-title" id="staticBackdropLabel">List TaskJob Group <span id="title_group"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="listDetailTaskJob">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="historyTaskJob" data-backdrop="static" data-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-white bg-primary">
                    <h5 class="modal-title" id="staticBackdropLabel">Log Running Hour <span id="name_taskjob">Nama
                            TaskJob</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="log-running-hour">

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="mb-4">
            <div class="row">
                <div class="col-8 text-left">
                    <h1 class="h3 mb-0 text-gray-800">TaskJob</h1>
                </div>
                <div class="col-4 text-right">
                    @if (auth()->user()->can('create taskjob'))
                        <a href="{{ route('taskjob-add') }}" class="btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i>
                            Create TaskJob</a>
                    @endif
                    @if (auth()->user()->can('create taskjob group'))
                        <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                            data-target="#staticBackdrop"><i class="fas fa-plus fa-sm text-white-50"></i>
                            Create Group</a>
                    @endif
                </div>
            </div>
            {{-- <input type="datetime-local"> --}}
        </div>

        {{-- @livewire('task-job'); --}}


        <div class="card">
            <div class="card-body" id="value-taskjob">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active text-primary font-weight-bold" id="home-tab" data-toggle="tab"
                            href="#home" role="tab" aria-controls="home" aria-selected="true">All Task Job</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-primary font-weight-bold" id="profile-tab" data-toggle="tab"
                            href="#profile" role="tab" aria-controls="profile" aria-selected="false">Group Task Job</a>
                    </li>
                    @if (auth()->user()->can('show taskjob group'))
                        <li class="nav-item text-primary font-weight-bold" role="presentation">
                            <a class="nav-link" id="group-tab" data-toggle="tab" href="#group" role="tab"
                                aria-controls="group" aria-selected="false">Group List</a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <br>
                        <div class="category-filter">
                            <select id="categoryFilter" class="form-control">
                                <option value="">All</option>
                                <option value="No-Critical">No Critical</option>
                                <option value="Critical !!!">Critical</option>
                            </select>
                        </div>
                        <table class="table table-striped table-responsive" id="table-listtaskjob">
                            <thead>
                                <th>No</th>
                                <th>Code Name</th>
                                <th>Job Desk</th>
                                <th>Status</th>
                                <th>Cost Estimation</th>
                                <th>Freq Interval</th>
                                <th>Due Date</th>
                                <th>Start Hour</th>
                                <th>End Hour</th>
                                <th>Running Hour</th>
                                <th>Life Time</th>
                                <th>Left Hour</th>
                                <th>Interval</th>
                                <th>Action</th>
                            </thead>
                            <tfoot>
                                <th>No</th>
                                <th>Code Name</th>
                                <th>Job Desk</th>
                                <th>Status</th>
                                <th>Cost Estimation</th>
                                <th>Freq Interval</th>
                                <th>Due Date</th>
                                <th>Start Hour</th>
                                <th>End Hour</th>
                                <th>Running Hour</th>
                                <th>Life Time</th>
                                <th>Left Hour</th>
                                <th>Interval</th>
                                <th>Action</th>
                            </tfoot>
                            <tbody>
                                @foreach ($taskjob as $t)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $t->code . '-' . $t->sub_group->name }}</td>
                                        <td>{!! $t->jobdesk !!}</td>
                                        <td>{!! $t->critical == 0 ? '<label class="badge badge-success p-2">No-Critical</label>' : '<label class="badge badge-danger p-2">Critical !!!</label>' !!}
                                        </td>
                                        <td>Rp. {{ number_format($t->cost) }}</td>
                                        <td>{{ $t->freq . ' ' . $t->id_freq }}</td>
                                        <td>{{ $t->due_date }}</td>
                                        <td>{{ $t->start_hour == null ? 'Not Procesed' : $t->start_hour }}</td>
                                        <td>{{ $t->end_hour == null ? 'Not Procesed' : $t->end_hour }}</td>
                                        <td>{{ $t->total_hour == 0 ? '0' : $t->total_hour }}</td>
                                        <td>{{ $t->life_time == 0 ? '0' : $t->life_time }}</td>
                                        <td>{{ $t->left_hour == 0 ? $t->interval : $t->left_hour }}</td>
                                        <td>{{ $t->interval == 0 ? '0' : $t->interval . ' Hour' }}</td>
                                        <td>
                                            <span data-toggle="tooltip" data-placement="bottom" title="Running Hour Taskjob">
                                                <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#runningHour" onclick="processRunningHour({{ $t->id }}, '{{ $t->code . '-' . $t->code . '-' . $t->sub_group->name }}')">
                                                    <i class="fa fa-clock"></i>
                                                </a>
                                            </span>
                                            <span data-toggle="tooltip" data-placement="bottom" title="History Taskjob">
                                            <a class="btn btn-sm btn-warning text-white" data-toggle="modal"
                                                data-target="#historyTaskJob"
                                                onclick="historyTaskJob({{ $t->log_taskjob }}, '{{ $t->sub_group->name }}')"><i
                                                    class="fa fa-history"></i></a>
                                            </span>
                                            @if (auth()->user()->can('give permission taskjob'))
                                            <span data-toggle="tooltip" data-placement="bottom" title="Give Permission Taskjob">
                                                <a class="btn btn-sm btn-secondary text-white" data-toggle="modal"
                                                    data-target="#giveRole"
                                                    onclick="giveRole({{ $t->id }}, '{{ $t->sub_group->name }}', '{{ auth()->user()->getRoleNames()->first() }}')"><i
                                                        class="fa fa-user"></i></a>
                                            </span>
                                            @endif
                                            @if (auth()->user()->can('edit taskjob'))
                                                <a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit Taskjob"
                                                    href="{{ route('edit-taskjob', $t->id) }}"><i
                                                        class="fa fa-edit"></i></a>
                                            @endif
                                            @if (auth()->user()->can('edit taskjob'))
                                                <form action="{{ route('delete-taskjob', $t->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete Taskjob"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <br>
                        <table class="table table-striped" id="table-group">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Total TaskJob</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Total TaskJob</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($group as $g)
                                    <tr
                                        class="{{ $g->count_taskjob->count() == 0 &&
!auth()->user()->can('give permission taskjob')
    ? 'd-none'
    : '' }}">
                                        <td>{{ $no_group++ }}</td>
                                        <td>{{ $g->name }}</td>
                                        <td>{{ $g->count_taskjob->count() }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary"
                                                onclick="listTaskJob({{ $g->count_taskjob }}, '{{ $g->name }}')"
                                                data-toggle="modal" data-target="#listTaskJob"><i
                                                    class="fa fa-list"></i></a>
                                            <a class="btn btn-sm btn-success" data-toggle="modal"
                                                data-target="#runningHourGroup"
                                                onclick="processRunningHourGroup({{ $g->id }}, '{{ $g->name }}')"><i
                                                    class="fa fa-clock"></i></a>
                                            @if (auth()->user()->can('give permission taskjob'))
                                                <a class="btn btn-sm btn-secondary" data-toggle="modal"
                                                    data-target="#giveRoleGroup"
                                                    onclick="giveRoleTaskJobGroup({{ $g->id }}, '{{ $g->name }}')"><i
                                                        class="fa fa-user"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (auth()->user()->can('show taskjob group'))
                        <div class="tab-pane fade" id="group" role="tabpanel" aria-labelledby="group-tab">
                            <br>
                            <table class="table table-striped" id="group-data">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        @if (auth()->user()->can('edit taskjob group') ||
        auth()->user()->can('delete taskjob group'))
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        @if (auth()->user()->can('edit taskjob group') ||
        auth()->user()->can('delete taskjob group'))
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($group as $g)
                                        <tr>
                                            <td>{{ $no_list_group++ }}</td>
                                            <td>{{ $g->name }}</td>
                                            @if (auth()->user()->can('edit taskjob group') ||
        auth()->user()->can('delete taskjob group'))
                                                <td>
                                                    @if (auth()->user()->can('edit taskjob group'))
                                                        <a class="btn btn-sm btn-primary" data-toggle="modal"
                                                            data-target="#editGroup"
                                                            onclick="groupEdit({{ $g->id }}, '{{ $g->name }}')"><i
                                                                class="fa fa-edit"></i></a>
                                                    @endif
                                                    @if (auth()->user()->can('delete taskjob group'))
                                                        <form class="d-inline"
                                                            action="{{ route('delete-group-taskjob', $g->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
@endsection
