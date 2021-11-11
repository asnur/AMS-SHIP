<?php

namespace App\Http\Livewire;

use App\Models\InventoryGroup;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Group extends Component
{

    public $selectedMainGroup;
    public $selectedGroup;
    public $selectedSubGroup;
    public $selectedUnit;
    public $selectedComponent;
    public $selectedGroupInventory;

    public $group;
    public $sub_group;
    public $unit;
    public $component;

    public $qty;

    protected $listeners =  [
        'selectMainGroup' => 'selectMainGroup',
        'selectGroup' => 'selectGroup',
        'selectSubGroup' => 'selectSubGroup',
        'selectUnit' => 'selectUnit',
        'selectComponent' => 'selectComponent',
        'selectGroupInventory' => 'selectGroupInventory'
    ];

    public function render()
    {
        $main_group = DB::table('group')->select('name', 'kode')->whereRaw('LENGTH(kode) = 1')->get();
        $part = DB::table('group')->select('name', 'kode', 'kode5')->where('kode5', '=', $this->selectedComponent)->whereRaw('LENGTH(kode) = 12')->get();
        $inventory_group = InventoryGroup::all();

        return view('livewire.group', compact(['main_group', 'part', 'inventory_group']));
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

    public function selectComponent($id)
    {
        $this->selectedComponent = $id;
        $this->part = DB::table('group')->select('name', 'kode', 'kode5')->where('kode5', '=', $this->selectedComponent)->whereRaw('LENGTH(kode) = 12')->get();
        $this->dispatchBrowserEvent('partData', ['part' => $this->part]);
    }

    public function selectGroupInventory($id)
    {
        $this->selectedGroupInventory = $id;
        $this->dispatchBrowserEvent('groupInventoryData', ['groupInventory' => $this->selectedGroupInventory]);
    }
}
