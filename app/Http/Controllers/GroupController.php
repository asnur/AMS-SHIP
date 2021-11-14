<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Group;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class GroupController extends Controller
{
    public function index()
    {
        // $start_time = "2021-10-11 11:00:00";
        // $finish_time = "2021-10-11 12:30:00";
        // dd(Carbon::parse($start_time)->floatDiffInHours($finish_time));
        $main_group = DB::table('group')->select('name', 'kode')->whereRaw('LENGTH(kode) = 1')->get();
        $group = DB::table('group')->select('name', 'kode', 'kode1')->whereRaw('LENGTH(kode) = 2')->get();
        $sub_group = DB::table('group')->select('name', 'kode', 'kode2')->whereRaw('LENGTH(kode) = 3')->get();
        $unit = DB::table('group')->select('name', 'kode', 'kode3')->whereRaw('LENGTH(kode) = 6')->get();
        $component = DB::table('group')->select('name', 'kode', 'kode4')->whereRaw('LENGTH(kode) = 9')->get();
        $part = DB::table('group')->select('name', 'kode', 'kode5')->whereRaw('LENGTH(kode) = 12')->get();
        return view('pages.admin.group', compact(['main_group', 'group', 'sub_group', 'unit', 'component', 'part']));
    }

    public function detail_unit(Request $request)
    {
        $data = Group::where('kode', $request->input('kode'))->first();

        return json_encode($data);
    }

    public function detail_component(Request $request)
    {
        $data = Group::where('kode', $request->input('kode'))->first();

        return json_encode($data);
    }

    public function detail_part(Request $request)
    {
        $data = Group::where('kode', $request->input('kode'))->first();

        return json_encode($data);
    }

    public function detail_sub_part($kode)
    {
        $sub_part = DB::table('group')->where('kode6', $kode)->whereRaw('LENGTH(kode) = 13')->get();
        $name = DB::table('group')->where('kode', $kode)->first();

        return view('pages.admin.sub_part', compact(['sub_part', 'name']));
    }

    public function detail_subpart(Request $request)
    {
        $data = Group::where('kode', $request->input('kode'))->first();

        return json_encode($data);
    }

    public function update_unit(Request $request)
    {
        $unit = Group::where('kode', $request->input('kode'))->first();
        $unit->spek = $request->input('spek');
        $unit->inspection = $request->input('inspection');

        $unit->save();
        Alert::success('Berhasil', 'Data Berhasil di Ubah');

        return redirect()->to('/admin/group');
    }

    public function update_component(Request $request)
    {
        $component = Group::where('kode', $request->input('kode'))->first();
        $component->spek = $request->input('spek');
        $component->inspection = $request->input('inspection');

        $component->save();
        Alert::success('Berhasil', 'Data Berhasil di Ubah');

        return redirect()->to('/admin/group');
    }

    public function update_part(Request $request)
    {
        $part = Group::where('kode', $request->input('kode'))->first();
        $part->spek = $request->input('spek');
        $part->inspection = $request->input('inspection');

        $part->save();
        Alert::success('Berhasil', 'Data Berhasil di Ubah');

        return redirect()->to('/admin/group');
    }

    public function update_sub_part(Request $request)
    {
        $sub_part = Group::where('kode', $request->input('kode'))->first();
        $sub_part->spek = $request->input('spek');
        $sub_part->inspection = $request->input('inspection');

        $sub_part->save();
        Alert::success('Berhasil', 'Data Berhasil di Ubah');

        return redirect()->to('/admin/detail-sub-part/' . $sub_part->kode6);
    }

    public function group_name(int $kode)
    {
        $group_name = Group::select('kode', 'name')->where('kode', $kode)->first();
        return $group_name->name;
    }
}
