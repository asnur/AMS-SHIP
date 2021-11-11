<?php

namespace App\Http\Controllers;

use App\Models\LogTaskJob;
use App\Models\Taskjob;
use Illuminate\Http\Request;
use App\Models\TaskjobGroup;

class TaskjobGroupController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission: create taskjob group', ['only' => ['store']]);
        // $this->middleware('permission: edit taskjob group', ['only' => ['update']]);
        // $this->middleware('permission: delete taskjob group', ['only' => ['update']]);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        TaskjobGroup::create($input);

        return redirect()->route('taskjob');
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $data = TaskjobGroup::find($input['id']);
        $data->update($input);

        return redirect()->route('taskjob');
    }

    public function destroy(int $id)
    {
        $data = TaskjobGroup::with('taskjob')->find($id);
        foreach ($data->taskjob as $dt) {
            Taskjob::find($dt->id)->delete();
            LogTaskJob::where('id_taskjob', $dt->id)->delete();
        }

        $data->delete();

        return redirect()->route('taskjob');
    }
}
