<?php

namespace App\Http\Livewire;

use Livewire\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

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
        $main_group = DB::table('group')->select('name', 'kode')->whereRaw('LENGTH(kode) = 1')->get();
        $group = DB::table('group')->select('name', 'kode', 'kode1')->whereRaw('LENGTH(kode) = 2')->get();
        $sub_group = DB::table('group')->select('name', 'kode', 'kode2')->whereRaw('LENGTH(kode) = 3')->get();
        $unit = DB::table('group')->select('name', 'kode', 'kode3')->whereRaw('LENGTH(kode) = 6')->get();
        $component = DB::table('group')->select('name', 'kode', 'kode4')->whereRaw('LENGTH(kode) = 9')->get();
        $part = DB::table('group')->select('name', 'kode', 'kode5')->whereRaw('LENGTH(kode) = 12')->get();
        // dd($main_group);
        // dd(strlen($group[0]->kode));
        return view('livewire.group-management', compact(['main_group', 'group', 'sub_group', 'unit', 'component', 'part']));
    }

    public function selectMainGroup($id)
    {
        $this->selectedMainGroup = $id;
        $this->group = DB::table('group')->select('name', 'kode', 'kode1')->where('kode1', '=', $this->selectedMainGroup)->whereRaw('LENGTH(kode) = 2')->get();
        $this->dispatchBrowserEvent('groupData', ['group' => $this->group]);
    }

    public function selectGroup($id)
    {
        $this->selectedGroup = $id;
        $this->sub_group = DB::table('group')->select('name', 'kode', 'kode2')->where('kode2', '=', $this->selectedGroup)->whereRaw('LENGTH(kode) = 3')->get();
        $this->dispatchBrowserEvent('subgroupData', ['subgroup' => $this->sub_group]);
    }

    public function selectSubGroup($id)
    {
        $this->selectedSubGroup = $id;
        $this->unit = DB::table('group')->select('name', 'kode', 'kode3')->where('kode3', '=', $this->selectedSubGroup)->whereRaw('LENGTH(kode) = 6')->get();
        $this->dispatchBrowserEvent('unitData', ['unit' => $this->unit]);
    }

    public function selectUnit($id)
    {
        $this->selectedUnit = $id;
        $this->component = DB::table('group')->select('name', 'kode', 'kode4')->where('kode4', '=', $this->selectedUnit)->whereRaw('LENGTH(kode) = 9')->get();
        $this->dispatchBrowserEvent('componentData', ['component' => $this->component]);
    }

    public function detailGrup($request)
    {
        //dd($request);
        $kode1 = $request['main_group'];
        //dd($kode1);
        $kode2 = $request['group'];
        $kode3 = $request['sub_group'];
        $kode4 = $request['unit'];
        $kode5 = $request['component'];
        $kode6 = ($request['part'] = '') ? ''  : $request['part']  ;
        $group = DB::table('group')->where('kode1', $kode1)->whereRaw('LENGTH(kode) = 2')->get();
        $sub_group = DB::table('group')->where('kode2', $kode2)->whereRaw('LENGTH(kode) = 3')->get();
        $unit = DB::table('group')->where('kode3', $kode3)->whereRaw('LENGTH(kode) = 6')->get();
        $component = DB::table('group')->where('kode4', $kode4)->whereRaw('LENGTH(kode) = 9')->get();
        $part = DB::table('group')->where('kode5', $kode5)->whereRaw('LENGTH(kode) >= 10 AND LENGTH(kode) <= 12')->get();
        $sub_part = DB::table('group')->where('kode', $kode6)->whereRaw('LENGTH(kode) = 13')->get();

        $this->dispatchBrowserEvent('detailGrupData',
        [
            'group' => $group,
            'sub_group' => $sub_group,
            'unit' => $unit,
            'component' => $component,
            'part' => $part,
            'sub_part' => $sub_part

        ]);
       // return json_encode(compact(['group', 'sub_group', 'unit', 'component', 'part', 'sub_part']));
    }
}
