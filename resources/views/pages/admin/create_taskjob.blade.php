@extends('layouts.layout')
@section('content')
    @php
    $no = 1;
    @endphp

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create New Taskjob</h1>
            {{-- <a href="{{ route('user-add') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create User</a> --}}
            {{-- <input type="datetime-local"> --}}
        </div>

        {{-- @livewire('task-job'); --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <form action="{{ route('add-taskjob') }}" method="POST">
                                <div class="row">
                                    <div class="col-12">
                                        @csrf
                                        <label for="kode" class="font-weight-bold">Code Name</label>
                                        <select class="form-control" name="kode" id="kode" required>
                                            @foreach ($group as $g)
                                                <option value="{{ $g->kode }}">{{ $g->kode . '-' . $g->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="kode" class="font-weight-bold mt-3">Group</label>
                                        <select class="form-control" name="group_id" id="group_id" required>
                                            @foreach ($group_taskjob as $gt)
                                                <option value="{{ $gt->id }}">{{ $gt->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="font-weight-bold mt-3">Job Desk</label>
                                        <textarea class="form-control" name="jobdesk" id="jobdesk" rows="5" placeholder="Input Jobdesk" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="font-weight-bold mt-3">Cost Estimation</label>
                                        <input class="form-control" type="number" name="cost" id="cost" placeholder="Input Cost Estimation" required>
                                    </div>
                                    <div class="col-10">
                                        <label for="" class="font-weight-bold mt-3">Freq</label>
                                        <input class="form-control" type="number" name="freq" id="freq" placeholder="Input number of frequencies" required>
                                    </div>
                                    <div class="col-2">
                                        <label for="" class="font-weight-bold mt-3">Freq Interval</label>
                                        <select class="form-control" name="id_freq" name="id_freq" required>
                                            @foreach ($freq as $f)
                                                <option value="{{ $f->name }}">{{ $f->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="font-weight-bold mt-3">Interval Running Hour</label>
                                        <input class="form-control" type="number" name="interval" placeholder="Input number of interval" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="font-weight-bold mt-3">Due Date (optional)</label>
                                        <input class="form-control" type="date" name="due_date" placeholder="Input number of interval">
                                    </div>
                                    <div class="col-12">
                                        <label for="" class="font-weight-bold mt-3">Critical</label><br>
                                        <input type="radio" name="critical" value="1" required> Yes
                                        <input type="radio" name="critical" value="0" required> No
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success mt-3"><i class="fa fa-paper-plane"></i>Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
