@extends('layouts.layout')
@section('content')
    @php
    $no = 1;
    @endphp

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create New User</h1>
            {{-- <a href="{{ route('user-add') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create User</a> --}}
            {{-- <input type="datetime-local"> --}}
        </div>

        {{-- @livewire('task-job'); --}}
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('add-user') }}" method="POST">
                            @csrf
                            <label class="font-weight-bold">Username</label>
                            <input type="text" class="form-control" name="name" placeholder="Input Username...." required>
                            <label class="font-weight-bold mt-3">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Input Email...." required>
                            <label class="font-weight-bold mt-3">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Input Password...."
                                required>
                            <label class="font-weight-bold mt-3">Role</label>
                            <select class="form-control" name="roles" id="roles">
                                <option>- Choose Role -</option>
                                @foreach ($roles as $r)
                                    <option value="{{ $r }}">{{ $r }}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-success mt-3"><i class="fa fa-paper-plane"></i>
                                Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
