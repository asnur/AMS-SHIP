@extends('layouts.layout')
@section('content')
    @php
    $no = 1;
    @endphp

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Role Management</h1>
            <a href="{{ route('role-add') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Role</a>
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
                                <th>Action</th>
                            </thead>
                            <tfoot>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tfoot>
                            <tbody>
                                @foreach ($roles as $r)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $r->name }}</td>
                                        <td>
                                            <a href="{{ route('edit-role', $r->id) }}" class="btn btn-sm btn-primary"><i
                                                    class="fa fa-edit"></i></a>
                                            <form action="{{ route('delete-role', $r->id) }}" class="d-inline"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
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

@endsection
