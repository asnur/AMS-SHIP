<?php

namespace App\Http\Livewire;

use Livewire\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\MainGroup;
use App\Models\Group;
use App\Models\SubGroup;
use App\Models\Unit;
use App\Models\Component as Comp;
use App\Models\Part;

class GroupManagement extends Component
{
    public $selectedMainGroup;
    public $selectedGroup;
    public $selectedSubGroup;
    public $selectedUnit;

    protected $listeners =  [
        'selectMainGroup' => 'selectMainGroup',
        'selectGroup' => 'selectGroup',
        'selectSubGroup' => 'selectSubGroup',
        'selectUnit' => 'selectUnit',
        'detailGrup' => 'detailGrup'
    ];

    public function render()
    {
        $main_group = DB::table('main_group')->select('id','name', 'code')->get();
        // $group = DB::table('group')->select('name', 'kode', 'kode1')->whereRaw('LENGTH(kode) = 2')->get();
        // $sub_group = DB::table('group')->select('name', 'kode', 'kode2')->whereRaw('LENGTH(kode) = 3')->get();
        // $unit = DB::table('group')->select('name', 'kode', 'kode3')->whereRaw('LENGTH(kode) = 6')->get();
        // $component = DB::table('group')->select('name', 'kode', 'kode4')->whereRaw('LENGTH(kode) = 9')->get();
        // $part = DB::table('group')->select('name', 'kode', 'kode5')->whereRaw('LENGTH(kode) = 12')->get();
        // dd($main_group);
        // dd(strlen($group[0]->kode));
        return view('livewire.group-management', compact(['main_group']));
    }

    public function selectMainGroup($id)
    {
        $this->selectedMainGroup = $id;
        $this->group = Group::select('id','name', 'code')->where('main_group_id', $this->selectedMainGroup)->get();
        $this->dispatchBrowserEvent('groupData', ['group' => $this->group]);
    }

    public function selectGroup($id)
    {
        $this->selectedGroup = $id;
        $this->sub_group = SubGroup::select('id','name', 'code')->where('group_id', $this->selectedGroup)->get();
        // dd($this->sub_group->pluck('name'));
        $this->dispatchBrowserEvent('subgroupData', ['subgroup' => $this->sub_group]);
    }

    public function selectSubGroup($id)
    {
        $this->selectedSubGroup = $id;
        // $this->unit = DB::table('group')->select('name', 'kode', 'kode3')->where('kode3', '=', $this->selectedSubGroup)->whereRaw('LENGTH(kode) = 6')->get();
        $this->unit = Unit::select('id','name', 'code')->where('sub_group_id', $this->selectedSubGroup)->get();
        $this->dispatchBrowserEvent('unitData', ['unit' => $this->unit]);
    }

    public function selectUnit($id)
    {
        $this->selectedUnit = $id;
        // $this->component = DB::table('group')->select('name', 'kode', 'kode4')->where('kode4', '=', $this->selectedUnit)->whereRaw('LENGTH(kode) = 9')->get();
        $this->component = Comp::select('id','name', 'code')->where('unit_id', $this->selectedUnit)->get();
        $this->dispatchBrowserEvent('componentData', ['component' => $this->component]);
    }

    public function detailGrup($request)
    {
        //dd($request);
        $mg = $request['main_group'];
        //dd($kode1);
        $g = $request['group'];
        $sg = $request['sub_group'];
        $u = $request['unit'];
        $c = $request['component'];
        $p = ($request['part'] = '') ? ''  : $request['part']  ;

        $group = Group::where('main_group_id', $mg)->get();
        $sub_group = SubGroup::where('group_id', $g)->get();
        $unit = Unit::where('sub_group_id', $sg)->get();
        $component = Comp::where('unit_id', $u)->get();
        $part = Part::where('component_id', $c)->get();

        $this->dispatchBrowserEvent('detailGrupData',
        [
            'group' => $group,
            'sub_group' => $sub_group,
            'unit' => $unit,
            'component' => $component,
            'part' => $part

        ]);
       // return json_encode(compact(['group', 'sub_group', 'unit', 'component', 'part', 'sub_part']));
    }
}
