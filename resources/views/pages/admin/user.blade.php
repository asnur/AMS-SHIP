@extends('layouts.layout')
@section('content')
    @php
    $no = 1;
    @endphp

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">User Management</h1>
            @if (auth()->user()->can('create user'))
                <a href="{{ route('user-add') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                        class="fas fa-plus fa-sm text-white-50"></i> Create User</a>
            @endif
            {{-- <input type="datetime-local"> --}}
        </div>

        {{-- @livewire('task-job'); --}}
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body" id="value-taskjob">
                        <table class="table table-striped " id="table">
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>E-Mail</th>
                                <th>Roles</th>
                                @if (auth()->user()->can('edit user') ||
        auth()->user()->can('delete user'))
                                    <th>Action</th>
                                @endif
                            </thead>
                            <tfoot>
                                <th>No</th>
                                <th>Name</th>
                                <th>E-Mail</th>
                                <th>Roles</th>
                                @if (auth()->user()->can('edit user') ||
        auth()->user()->can('delete user'))
                                    <th>Action</th>
                                @endif
                            </tfoot>
                            <tbody>
                                @foreach ($data as $v)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $v->name }}</td>
                                        <td>{{ $v->email }}</td>
                                        <td>
                                            @if (!empty($v->getRoleNames()))
                                                @foreach ($v->getRoleNames() as $role)
                                                    <label class="badge badge-success">{{ $role }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        @if (auth()->user()->can('edit user') ||
        auth()->user()->can('delete user'))
                                            <td>
                                                @if (auth()->user()->can('edit user'))
                                                    <a href="{{ route('edit-user', $v->id) }}"
                                                        class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                @endif
                                                @if (auth()->user()->can('delete user'))
                                                    <form action="{{ route('delete-user', $v->id) }}"
                                                        class="d-inline" method="POST">
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
                </div>
            </div>
        </div>
    </div>

@endsection
