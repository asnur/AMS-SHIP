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
        $main_group = DB::table('group')->select('name', 'kode')
        ->whereRaw('LENGTH(kode) = 1')
        ->orWhereRaw('LENGTH(kode1) = 2')
        ->get();
        // dd($main_group->pluck('kode'));
        $group = DB::table('group')->select('name', 'kode', 'kode1')->whereRaw('LENGTH(kode) = 2')->get();
        $sub_group = DB::table('group')->select('name', 'kode', 'kode2')->whereRaw('LENGTH(kode) = 3')->get();
        $unit = DB::table('group')->select('name', 'kode', 'kode3')->whereRaw('LENGTH(kode) = 6')->get();
        $component = DB::table('group')->select('name', 'kode', 'kode4')->whereRaw('LENGTH(kode) = 9')->get();
        $part = DB::table('group')->select('name', 'kode', 'kode5')->whereRaw('LENGTH(kode) = 12')->get();
        return view('pages.admin.group', compact(['main_group', 'group', 'sub_group', 'unit', 'component', 'part']));
    }

    public function create_group(Request $request)
    {
        if($request->input('choose') == 'main_group'){
            // $count = count($request->input('main_group'));
            // dd($count);
            if (is_null($request->input('main_group')) || is_null($request->input('choose'))){
                Alert::error('All field Must Be Filled', 'Failed');
                return redirect()->route('group');
            }
            $getkode1 = DB::table('group')->select('kode1')->orderBy('id', 'desc')->whereRaw('LENGTH(kode) = 1')->orWhereRaw('LENGTH(kode1) = 2')
            ->first();

            if(is_null($getkode1)){
                $kode1 = 1;
            }
            else {
                $kode1 = $getkode1->kode1 + 1 ;
            };
            // dd($request->all());
            $kode1 = $kode1++;
            $kode2 = str_pad($kode1,2,"0");
            $kode3 = str_pad($kode1,3,"0");
            $kode4 = str_pad($kode1,6,"0");
            $kode5 = str_pad($kode1,9,"0");
            $kode6 = str_pad($kode1,12,"0");
            $name = $request->input('main_group');
            dd($kode1,$kode2,$kode3,$kode4,$kode5,$kode6,$name);

            for($i = 0 ; $i < count($request->input('main_group')) ; $i++){
                Group::create([
                    'kode1' => $kode1,
                    'kode2' => $kode2++,
                    'kode3' => $kode3,
                    'kode4' => $kode4,
                    'kode5' => $kode5,
                    'kode6' => $kode6,
                    'kode' => $kode1++,
                    'name' => $name[$i]
                ]);
            };

            Alert::success('Main Group has been created', 'Success');
            return redirect()->route('group');

        }

        else if($request->input('choose') == 'group'){
            // dd($request->all());
            if (is_null($request->input('group')) || is_null($request->input('spek')
            || is_null($request->input('kodeMainGroup')))){
                Alert::error('Field Name Group Must Be Filled' , 'Failed');
                return redirect()->route('group');
            }
            $getkode2 = DB::table('group')->select('kode2')
            ->where('kode1' ,'=' ,$request->input('kodeMainGroup'))
            ->whereRaw('LENGTH(kode) = 2')
            ->orderBy('id', 'desc')->first();
            // dd($getkode2->kode2);
            if(is_null($getkode2)){
                $kode1 = $request->input('kodeMainGroup');
                $kode2 = $request->input('kodeMainGroup') .+ '1';
            }
            else {
                $kode1 = $request->input('kodeMainGroup');
                $kode2 = $getkode2->kode2 + 1 ;
            };

            $kode1 = $request->input('kodeMainGroup');
            $kode2 = $kode2;
            $kode3 = str_pad($kode2,3,"0");
            $kode4 = str_pad($kode2,6,"0");
            $kode5 = str_pad($kode2,9,"0");
            $kode6 = str_pad($kode2,12,"0");
            $name = $request->input('group');
            $spek = $request->input('spek');
            // dd($kode1,$kode2,$kode3,$kode4,$kode5,$kode6,);

            for($i = 0 ; $i < count($request->input('group')) ; $i++){
                Group::create([
                    'kode1' => $kode1,
                    'kode2' => $kode2,
                    'kode3' => $kode3,
                    'kode4' => $kode4,
                    'kode5' => $kode5,
                    'kode6' => $kode6,
                    'kode' => $kode2++,
                    'name' => $name[$i],
                    'spek' => $spek[$i]
                ]);
            };

            Alert::success('Group has been created', 'Success');
            return redirect()->route('group');
        }

        else if($request->input('choose') == 'sub_group'){
            // dd($request->all());

            if (is_null($request->input('sub_group')) || is_null($request->input('spek'))
            || is_null($request->input('kodeMainGroup')) || is_null($request->input('kodeGroup')) ){
                Alert::error('Field Name Sub Group Must Be Filled', 'Failed');
                return redirect()->route('group');
            }
            $getkode3 = DB::table('group')->select('kode3')
            ->where([
                ['kode1' , '=' ,$request->input('kodeMainGroup')],
                ['kode2' , '=' ,$request->input('kodeGroup')]
            ])
            ->whereRaw('LENGTH(kode) = 3')
            ->orderBy('id', 'desc')->first();

            if(is_null($getkode3)){
                $kode1 = $request->input('kodeMainGroup');
                $kode2 = $request->input('kodeGroup');
                $kode3 = $request->input('kodeGroup') .+ '1' ;
            }
            else {
                $kode1 = $request->input('kodeMainGroup');
                $kode2 = $request->input('kodeGroup');
                $kode3 = $getkode3->kode3 + 1 ;
            };
            $kodeMainGroup = $kode1 ;
            $kodeGroup = $kode2;
            $kodeSubGroup = $kode3 ;
            $kodeUnit = $kodeSubGroup .+ '0' .+ '0' .+ '0';
            $kodeComponent = $kodeUnit .+ '0' .+ '0' .+ '0';
            $kodePart = $kodeComponent .+ '0' .+ '0' .+ '0';
            $name = $request->input('sub_group');
            $spek = $request->input('spek');
            // dd($kodeMainGroup,$kodeGroup,$kodeSubGroup,$kodeUnit,$kodeComponent,$kodePart,);

            for($i = 0 ; $i < count($request->input('sub_group')) ; $i++){
                Group::create([
                    'kode1' => $kodeMainGroup,
                    'kode2' => $kodeGroup,
                    'kode3' => $kodeSubGroup,
                    'kode4' => $kodeUnit,
                    'kode5' => $kodeComponent,
                    'kode6' => $kodePart,
                    'kode' => $kodeSubGroup++,
                    'name' => $name[$i],
                    'spek' => $spek[$i]
                ]);
            };

            Alert::success('Sub Group has been created', 'Success');
            return redirect()->route('group');
        }

        else if($request->input('choose') == 'unit'){
            // dd($request->all());
            if (is_null($request->input('unit')) || is_null($request->input('spek'))
            || is_null($request->input('kodeMainGroup')) || is_null($request->input('kodeGroup'))
            || is_null($request->input('kodeSubGroup')) || is_null($request->input('inspect'))){
                Alert::error('All Field Must Be Filled', 'Failed');
                return redirect()->route('group');
            }

            $getkode4 = DB::table('group')->select('kode4')
            ->where([
                ['kode1' , '=' ,$request->input('kodeMainGroup')],
                ['kode2' , '=' ,$request->input('kodeGroup')],
                ['kode3' , '=' ,$request->input('kodeSubGroup')]
            ])
            ->whereRaw('LENGTH(kode) = 6')
            ->orderBy('id', 'desc')->first();

            if(is_null($getkode4)){
                $kode1 = $request->input('kodeMainGroup');
                $kode2 = $request->input('kodeGroup');
                $kode3 = $request->input('kodeSubGroup');
                $kode4 = $request->input('kodeSubGroup') .+ '0' .+ '0'.+ '1';
            }
            else {
                $kode1 = $request->input('kodeMainGroup');
                $kode2 = $request->input('kodeGroup');
                $kode3 = $request->input('kodeSubGroup');
                $kode4 =  $getkode4->kode4 + 1 ;
            };
            $kodeMainGroup = $kode1 ;
            $kodeGroup = $kode2;
            $kodeSubGroup = $kode3 ;
            $kodeUnit = $kode4;
            $kodeComponent = $kodeUnit .+ '0' .+ '0' .+ '0';
            $kodePart = $kodeComponent .+ '0' .+ '0' .+ '0';
            $name = $request->input('unit');
            $spek = $request->input('spek');
            $inspection = $request->input('inspect');
            // dd($kodeMainGroup,$kodeGroup,$kodeSubGroup,$kodeUnit,$kodeComponent,$kodePart,);

            for($i = 0 ; $i < count($request->input('unit')) ; $i++){
                Group::create([
                    'kode1' => $kodeMainGroup,
                    'kode2' => $kodeGroup,
                    'kode3' => $kodeSubGroup,
                    'kode4' => $kodeUnit,
                    'kode5' => $kodeComponent,
                    'kode6' => $kodePart,
                    'kode' => $kodeUnit++,
                    'name' => $name[$i],
                    'spek' => $spek[$i],
                    'inspection' => $inspection[$i]
                ]);
            };

            Alert::success('Unit has been created', 'Success');
            return redirect()->route('group');
            // dd($kode5);
        }

        else if($request->input('choose') == 'component'){
            // dd($request->all());
            if (is_null($request->input('component')) || is_null($request->input('spek'))
            || is_null($request->input('kodeMainGroup')) || is_null($request->input('kodeGroup'))
            || is_null($request->input('kodeSubGroup')) || is_null($request->input('kodeUnit'))
            || is_null($request->input('inspect'))){
                Alert::error('All Field Must Be Filled', 'Failed');
                return redirect()->route('group');
            }
            $getkode5 = DB::table('group')->select('kode5')
            ->where([
                ['kode1' , '=' ,$request->input('kodeMainGroup')],
                ['kode2' , '=' ,$request->input('kodeGroup')],
                ['kode3' , '=' ,$request->input('kodeSubGroup')],
                ['kode4' , '=' ,$request->input('kodeUnit')]
            ])
            ->whereRaw('LENGTH(kode) = 9')
            ->orderBy('id', 'desc')->first();

            if(is_null($getkode5)){
                $kode1 = $request->input('kodeMainGroup');
                $kode2 = $request->input('kodeGroup');
                $kode3 = $request->input('kodeSubGroup');
                $kode4 = $request->input('kodeUnit');
                $kode5 = $request->input('kodeUnit') .+ '0' .+ '0'.+ '1';
            }
            else {
                $kode1 = $request->input('kodeMainGroup');
                $kode2 = $request->input('kodeGroup');
                $kode3 = $request->input('kodeSubGroup');
                $kode4 = $request->input('kodeUnit');
                $kode5 = $getkode5->kode5 + 1 ;
            };
            $kodeMainGroup = $kode1 ;
            $kodeGroup = $kode2;
            $kodeSubGroup = $kode3 ;
            $kodeUnit = $kode4;
            $kodeComponent = $kode5;
            $kodePart = $kodeComponent .+ '0' .+ '0' .+ '0';
            $name = $request->input('component');
            $spek = $request->input('spek');
            $inspection = $request->input('inspect');
            // dd($kodeMainGroup,$kodeGroup,$kodeSubGroup,$kodeUnit,$kodeComponent,$kodePart,);

            for($i = 0 ; $i < count($request->input('component')) ; $i++){
                Group::create([
                    'kode1' => $kodeMainGroup,
                    'kode2' => $kodeGroup,
                    'kode3' => $kodeSubGroup,
                    'kode4' => $kodeUnit,
                    'kode5' => $kodeComponent,
                    'kode6' => $kodePart,
                    'kode' => $kodeComponent++,
                    'name' => $name[$i],
                    'spek' => $spek[$i],
                    'inspection' => $inspection[$i]
                ]);
            };

            Alert::success('Component has been created', 'Success');
            return redirect()->route('group');

        }

        elseif ($request->input('choose') == 'part'){
            // dd($request->all());
            if (is_null($request->input('part')) || is_null($request->input('spek'))
            || is_null($request->input('kodeMainGroup')) || is_null($request->input('kodeGroup'))
            || is_null($request->input('kodeSubGroup')) || is_null($request->input('kodeUnit'))
            || is_null($request->input('inspect')) || is_null($request->input('kodeComponent'))){
                Alert::error('All Field Must Be Filled', 'Failed');
                return redirect()->route('group');
            }
            $getkode6 = DB::table('group')->select('kode6')
            ->where([
                ['kode1' , '=' ,$request->input('kodeMainGroup')],
                ['kode2' , '=' ,$request->input('kodeGroup')],
                ['kode3' , '=' ,$request->input('kodeSubGroup')],
                ['kode4' , '=' ,$request->input('kodeUnit')],
                ['kode5' , '=' ,$request->input('kodeComponent')]
            ])
            ->whereRaw('LENGTH(kode) = 12')
            ->orderBy('id', 'desc')->first();

            if(is_null($getkode6)){
                $kode1 = $request->input('kodeMainGroup');
                $kode2 = $request->input('kodeGroup');
                $kode3 = $request->input('kodeSubGroup');
                $kode4 = $request->input('kodeUnit');
                $kode5 = $request->input('kodeComponent');
                $kode6 = $request->input('kodeComponent') .+ '0' .+ '0'.+ '1';
            }
            else {
                $kode1 = $request->input('kodeMainGroup');
                $kode2 = $request->input('kodeGroup');
                $kode3 = $request->input('kodeSubGroup');
                $kode4 = $request->input('kodeUnit');
                $kode5 = $request->input('kodeComponent');
                $kode6 = $getkode6->kode6 + 1 ;
            };

            $kodeMainGroup = $kode1 ;
            $kodeGroup = $kode2;
            $kodeSubGroup = $kode3 ;
            $kodeUnit = $kode4;
            $kodeComponent = $kode5;
            $kodePart = $kode6;
            $name = $request->input('part');
            $spek = $request->input('spek');
            $inspection = $request->input('inspect');
            // dd($kodeMainGroup,$kodeGroup,$kodeSubGroup,$kodeUnit,$kodeComponent,$kodePart,);

            for($i = 0 ; $i < count($request->input('part')) ; $i++){
                Group::create([
                    'kode1' => $kodeMainGroup,
                    'kode2' => $kodeGroup,
                    'kode3' => $kodeSubGroup,
                    'kode4' => $kodeUnit,
                    'kode5' => $kodeComponent,
                    'kode6' => $kodePart,
                    'kode' => $kodePart++,
                    'name' => $name[$i],
                    'spek' => $spek[$i],
                    'inspection' => $inspection[$i]
                ]);
            };

            Alert::success('Part has been created', 'Success');
            return redirect()->route('group');
        }
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
