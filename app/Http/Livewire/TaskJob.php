<?php

namespace App\Http\Livewire;

use App\Models\Taskjob as ModelsTaskjob;
use Livewire\Component;
use Illuminate\Http\Request;

class TaskJob extends Component
{
    public $id_barang;
    protected $listeners = [
        'reload' => 'render'
    ];

    public function render()
    {
        $taskjob = ModelsTaskjob::join('tbl_periode', 'tbl_taskjob.id_periode', '=', 'tbl_periode.id')->get();
        $no = 1;

        return view('livewire.task-job', compact(['taskjob', 'no']));
    }


    public function start($data)
    {
        $id_barang = explode(",", $data['id_barang']);

        foreach ($id_barang as $data) {
            $taskjob = ModelsTaskjob::where('id_barang', $data)->first();
            $taskjob->running_action = 1;

            $taskjob->save();
        }

        $this->dispatchBrowserEvent('reload-datatables');
        // return redirect()->to('/admin/taskjob');
    }
    public function stop($id)
    {
        $taskjob = ModelsTaskjob::where('id_barang', $id)->first();
        $taskjob->running_action = 0;

        $taskjob->save();

        // return redirect()->to('/admin/taskjob');
    }
}
