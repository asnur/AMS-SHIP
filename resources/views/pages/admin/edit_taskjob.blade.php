@extends('layouts.layout')
@section('content')
    @php
    $no = 1;
    @endphp

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Taskjob</h1>
            {{-- <a href="{{ route('user-add') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create User</a> --}}
            {{-- <input type="datetime-local"> --}}
        </div>

        {{-- @livewire('task-job'); --}}
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('update-taskjob') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $taskjob->id }}" name="id">
                            <label for="kode" class="font-weight-bold">Code Name</label>
                            <select class="form-control" name="kode" id="kode" required>
                                @foreach ($group as $g)
                                    <option value="{{ $g->kode }}"
                                        {{ $g->kode == $taskjob->kode ? 'selected' : '' }}>
                                        {{ $g->kode . '-' . $g->name }}</option>
                                @endforeach
                            </select>
                            <label for="kode" class="font-weight-bold mt-3">Group</label>
                            <select class="form-control" name="group_id" id="group_id" required>
                                @foreach ($group_taskjob as $gt)
                                    <option value="{{ $gt->id }}"
                                        {{ $gt->id == $taskjob->group_id ? 'selected' : '' }}>{{ $gt->name }}</option>
                                @endforeach
                            </select>
                            <label for="" class="font-weight-bold mt-3">Job Desk</label>
                            <textarea class="form-control" name="jobdesk" id="jobdesk" rows="5"
                                placeholder="Input Jobdesk" required>{!! $taskjob->jobdesk !!}</textarea>
                            <label for="" class="font-weight-bold mt-3">Cost Estimation</label>
                            <input class="form-control" type="number" name="cost" id="cost"
                                placeholder="Input Cost Estimation" value="{{ $taskjob->cost }}" required>
                            <label for="" class="font-weight-bold mt-3">Freq</label>
                            <input class="form-control" type="number" value="{{ $taskjob->freq }}" name="freq" id="freq"
                                placeholder="Input number of frequencies" required>
                            <label for="" class="font-weight-bold mt-3">Freq Interval</label>
                            <select class="form-control" name="id_freq" name="id_freq" required>
                                @foreach ($freq as $f)
                                    <option value="{{ $f->name }}"
                                        {{ $f->name == $taskjob->id_freq ? 'selected' : '' }}>
                                        {{ $f->name }}</option>
                                @endforeach
                            </select>
                            <label for="" class="font-weight-bold mt-3">Interval Running Hour</label>
                            <input class="form-control" type="number" name="interval"
                                placeholder="Input number of interval" value="{{ $taskjob->interval }}" required>
                            <label for="" class="font-weight-bold mt-3">Due Date (optional)</label>
                            <input class="form-control" type="date" name="due_date" placeholder="Input number of interval"
                                value="{{ date('Y-m-d', strtotime($taskjob->due_date)) }}" required>
                            <label for="" class="font-weight-bold mt-3">Critical</label><br>
                            <input type="radio" name="critical" value="1" {{ $taskjob->critical == 1 ? 'checked' : '' }}
                                required> Yes
                            <input type="radio" name="critical" value="0" {{ $taskjob->critical == 0 ? 'checked' : '' }}
                                required> No
                    </div>
                </div>
                <button
                    type="
                                                                                                                                                                                        submit"
                    class="btn btn-success mt-3"><i class="fa fa-paper-plane"></i>Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection
