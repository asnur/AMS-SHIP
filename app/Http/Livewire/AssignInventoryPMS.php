<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\InventoryGroup;
use App\Models\InventoryStock;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class AssignInventoryPMS extends Component
{
    public $InventoryGroup = '';
    public $group_code;
    public $idGroupInventory;
    protected $listeners = [
        'setInventoryGroup' => 'setInventoryGroup',
        'assignGroupInventory' => 'assignGroupInventory',
        'setGroupCode' => 'setGroupCode',
        'getListInventory' => 'getListInventory',
    ];

    public function render()
    {
        $group_inventory = InventoryGroup::get();
        return view('livewire.assign-inventory-p-m-s', compact(['group_inventory']));
    }

    public function setInventoryGroup($id)
    {
        $this->idGroupInventory = $id;
    }

    public function assignGroupInventory()
    {
        if ($this->idGroupInventory !== null) {
            $data = Group::where('kode',  $this->group_code)->first();
            $data->update(['assign_inventory' => $this->idGroupInventory]);
        }
        $this->dispatchBrowserEvent('assignInventory', ['idGroupInventory' => $this->idGroupInventory, 'group_code' => $this->group_code]);
    }

    public function setGroupCode($kode)
    {
        $this->group_code = $kode;
    }

    public function getListInventory($id_group)
    {
        $dataInventory = InventoryStock::with('group')->where('id_group', $id_group)->get();

        $this->dispatchBrowserEvent('listInventory', ['listItem' => $dataInventory]);
    }
}
