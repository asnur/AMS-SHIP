<?php

namespace App\Http\Controllers;

use App\Models\Freq;
use Illuminate\Http\Request;
use App\Models\Taskjob;
use App\Models\Group;
use App\Models\LogTaskJob;
use App\Models\TaskjobGroup;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

// use Alert;

class TaskjobController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:show taskjob|create taskjob|edit taskjob|delete taskjob|give permission taskjob|create taskjob group|edit taskjob group|delete taskjob group|show taskjob group', ['only' => ['index']]);
        $this->middleware('permission:create taskjob', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit taskjob', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete taskjob', ['only' => ['destroy']]);
        $this->middleware('permission:give permission taskjob', ['only' => ['give_role', 'give_role_group']]);
    }

    public function index()
    {
        $taskjob = [];

        if (Auth::user()->can('give permission taskjob')) {
            $taskjob = Taskjob::with(['group', 'log_taskjob'])->get();
        } else {
            $taskjob = Taskjob::with(['group', 'log_taskjob'])->where('role', Auth::user()->getRoleNames()->first())->get();
        }
        $group = TaskjobGroup::with('count_taskjob')->get();
        $roles = Role::get();

        return view('pages.admin.taskjob', compact(['taskjob', 'group', 'roles']));
    }

    public function create()
    {
        $group = Group::select('kode', 'name')->whereRaw('LENGTH(kode) = 3')->get();
        $freq = Freq::get();
        $group_taskjob = TaskjobGroup::get();

        return view('pages.admin.create_taskjob', compact(['group', 'freq', 'group_taskjob']));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($data['due_date'] == '') {
            $interval = "+" . $data['freq'] . " " . $data['id_freq'];
            $data['due_date'] = date('Y-m-d', strtotime($interval, strtotime(date('Y-m-d'))));
        }
        $data += [
            'left_hour' => $data['interval'],
            'fix_interval' => $data['interval']
        ];

        Taskjob::create($data);

        return redirect()->route('taskjob');
    }

    public function edit(int $id)
    {
        $taskjob = Taskjob::find($id);
        $group = Group::select('kode', 'name')->whereRaw('LENGTH(kode) = 3')->get();
        $freq = Freq::get();
        $group_taskjob = TaskjobGroup::get();

        return view('pages.admin.edit_taskjob', compact(['taskjob', 'group', 'freq', 'group_taskjob']));
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $data = Taskjob::find($input['id']);
        $left_hour = 0;

        if ($input['interval'] !== $data->interval) {
            $left_hour = $request->input('interval') - $data->life_time;
        }

        $input += [
            'left_hour' => $left_hour
        ];

        $data->update($input);

        return redirect()->route('taskjob');
    }

    public function destroy(int $id)
    {
        Taskjob::find($id)->delete();

        return redirect()->route('taskjob');
    }

    public function running_hour(Request $request)
    {
        $data_taskjob = Taskjob::find($request->input('id'));
        $total_hour = Carbon::parse($request->input('start_hour'))->floatDiffInHours($request->input('end_hour'));
        $life_time = 0;
        $left_hour = 0;
        $fix_interval = 0;
        if ($data_taskjob->life_time == 0) {
            $life_time = $total_hour;
            $data_taskjob->life_time = $total_hour;
            $left_hour = $data_taskjob->interval - $life_time;
            $fix_interval = (ceil($total_hour / $data_taskjob->interval) == 0) ? 1 : ceil($total_hour / $data_taskjob->fix_interval);
        } else {
            $life_time = $data_taskjob->life_time;
            $data_taskjob->life_time = $life_time + $total_hour;
            $left_hour = $data_taskjob->left_hour - $total_hour;
        }
        $data_taskjob->start_hour = $request->input('start_hour');
        $data_taskjob->end_hour = $request->input('end_hour');
        $data_taskjob->total_hour = $total_hour;
        $data_taskjob->left_hour = $left_hour;
        $data_taskjob->save();

        $fix_interval = ceil($data_taskjob->life_time / $data_taskjob->fix_interval);


        if ($data_taskjob->life_time >= $data_taskjob->interval) {
            $data_taskjob->interval = $fix_interval * $data_taskjob->fix_interval;
            $data_taskjob->save();
            $data_taskjob->left_hour = $data_taskjob->interval - $data_taskjob->life_time;
            $data_taskjob->save();
        }

        LogTaskJob::create(
            [
                'id_taskjob' => $request->input('id'),
                'start_hour' => $request->input('start_hour'),
                'end_hour' => $request->input('end_hour'),
                'total_hour' => $total_hour
            ]
        );

        return redirect()->route('taskjob');
    }

    public function running_hour_group(Request $request)
    {
        $taskjob = TaskjobGroup::with('taskjob')->find($request->input('id'));
        // dd($taskjob);
        $total_hour = Carbon::parse($request->input('start_hour'))->floatDiffInHours($request->input('end_hour'));
        $life_time = 0;
        $left_hour = 0;

        foreach ($taskjob->taskjob as $tj) {
            $data_taskjob = Taskjob::findOrFail($tj->id);
            if ($data_taskjob->life_time == 0) {
                $life_time = $total_hour;
                $data_taskjob->life_time = $total_hour;
                $left_hour = $data_taskjob->interval - $life_time;
            } else {
                $life_time = $data_taskjob->life_time;
                $data_taskjob->life_time = $life_time + $total_hour;
                $left_hour = $data_taskjob->left_hour - $total_hour;
            }
            $data_taskjob->start_hour = $request->input('start_hour');
            $data_taskjob->end_hour = $request->input('end_hour');
            $data_taskjob->total_hour = $total_hour;
            $data_taskjob->left_hour = $left_hour;
            $data_taskjob->save();

            LogTaskJob::create(
                [
                    'id_taskjob' => $tj->id,
                    'start_hour' => $request->input('start_hour'),
                    'end_hour' => $request->input('end_hour'),
                    'total_hour' => $total_hour
                ]
            );
        }

        return redirect()->route('taskjob');
    }

    public function give_role(Request $request)
    {
        $input = $request->all();
        Taskjob::find($input['id'])->update($input);

        return redirect()->route('taskjob');
    }

    public function give_role_group(Request $request)
    {
        $data = TaskjobGroup::with('count_taskjob')->find($request->input('id'));
        foreach ($data->count_taskjob as $d) {
            $data_taskjob = Taskjob::find($d->id);
            $data_taskjob->role = $request->input('role');
            $data_taskjob->save();
        }

        return redirect()->route('taskjob');
    }
}
