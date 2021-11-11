@extends('layouts.layout')
@section('content')
    @php
    $no = 1;
    @endphp

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create New Role</h1>
            {{-- <a href="{{ route('user-add') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create User</a> --}}
            {{-- <input type="datetime-local"> --}}
        </div>

        {{-- @livewire('task-job'); --}}
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('add-role') }}" method="POST">
                            @csrf
                            <label class="font-weight-bold">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Input Username...." required>
                            <label class="font-weight-bold mt-3">Permission</label>
                            <div class="form-check">
                                <div class="row">
                                    <div class="col-4">
                                        @foreach ($permission_user as $p)
                                            <input type="checkbox" class="form-check-input" name="permission[]"
                                                value="{{ $p->name }}">{{ $p->name }}<br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3"><i class="fa fa-paper-plane"></i>
                    Send</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
