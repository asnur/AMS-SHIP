<?php

namespace App\Http\Controllers;

use App\Models\Taskjob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailPMS;

class PMSController extends Controller
{
    //

    public function index()
    {
        $upcoming = Taskjob::with(['sub_group', 'log_taskjob'])->where('role', Auth::user()->getRoleNames()->first())->where('pms', 'upcoming')->get();
        $ongoing = Taskjob::with(['sub_group', 'log_taskjob'])->where('role', Auth::user()->getRoleNames()->first())->where('pms', 'ongoing')->get();
        $finished = Taskjob::with(['sub_group', 'log_taskjob'])->where('role', Auth::user()->getRoleNames()->first())->where('pms', 'finished')->get();
        // ddd($upcoming);
        return view('pages.admin.pms', compact(['ongoing', 'upcoming', 'finished']));
    }

    public function open_pms(Request $request)
    {
        $taskjob = Taskjob::find($request->input('id'));
        $taskjob->pms = "ongoing";
        $taskjob->save();

        return redirect()->route('PMS');
    }

    public function assign_pms(Request $request)
    {
        $name_image1 = $request->input('id_taskjob') . '-' . time() . '-1' . '.' . $request->file('image_1')->extension();
        $request->file('image_1')->move(public_path('pms'), $name_image1);
        $name_image2 = $request->input('id_taskjob') . '-' . time() . '-2' . '.' . $request->file('image_2')->extension();
        $request->file('image_2')->move(public_path('pms'), $name_image2);
        $name_image3 = $request->input('id_taskjob') . '-' . time() . '-3' . '.' . $request->file('image_3')->extension();
        $request->file('image_3')->move(public_path('pms'), $name_image3);

        $data = $request->all();
        $data['image_1'] = $name_image1;
        $data['image_2'] = $name_image2;
        $data['image_3'] = $name_image3;

        DetailPMS::create($data);
        $taskjob = Taskjob::find($request->input('id_taskjob'));
        $taskjob->pms = 'finished';
        $taskjob->save();

        return redirect()->route('PMS');
    }

    public function preview_pms(Request $request)
    {
        $data = Taskjob::with(['detail', 'group'])->where('id', $request->id)->first();

        return $data;
    }
}
