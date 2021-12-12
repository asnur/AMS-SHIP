<?php

namespace App\Http\Controllers;

use App\Models\MainGroup;
use App\Models\Group;
use App\Models\SubGroup;
use App\Models\Unit;
use App\Models\Component;
use App\Models\Part;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\InventoryGroup;
use App\Models\InventoryStock;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory_group = InventoryGroup::has('inventory')->get();
        // $inventory_group = Inventory::select('installed','used','reserved','ready')->has('inventory_group')->get();

        // dd($inventory_group);
        // foreach($inventory_group as $inv){
        //     dd($inv->inventory);
        //     foreach($inv->inventory as $inven){
        //         dd($inven->ready);
        //     }
        // }
        // dd($inventory_group->inventory);
        // $main_group = DB::table('group')->select('name', 'kode')->whereRaw('LENGTH(kode) = 1')->get();
        $main_group = MainGroup::select('id','name','code')->get();
        $all_inventory = Inventory::with('part')->get();
        // $inventory = Inventory::
        // $group = DB::table('group')->select('name', 'kode', 'kode1')->whereRaw('LENGTH(kode) = 2')->get();
        // $sub_group = DB::table('group')->select('name', 'kode', 'kode2')->whereRaw('LENGTH(kode) = 3')->get();
        // $unit = DB::table('group')->select('name', 'kode', 'kode3')->whereRaw('LENGTH(kode) = 6')->get();
        // $component = DB::table('group')->select('name', 'kode', 'kode4')->whereRaw('LENGTH(kode) = 9')->get();
        // $part = DB::table('group')->select('name', 'kode', 'kode5')->whereRaw('LENGTH(kode) = 12')->get();
        // return view('pages/admin/inventory', compact(['inventory_group', 'main_group', 'group', 'sub_group', 'unit', 'component', 'part']));
        return view('pages/admin/inventory', compact(['inventory_group','all_inventory' ,'main_group']));
    }

    public function all_inventory()
    {

        $all_inventory = Inventory::with('part')->get();
        $data['data'] = $all_inventory;

        return json_encode($data, 1);
    }

    public function add_group(Request $request)
    {
        $data = $request->all();
        InventoryGroup::create($data);

        return redirect()->route('inventory');
    }

    public function edit_group(Request $request)
    {
        $data = InventoryGroup::find($request->input('id'));
        $data->update($request->all());

        return redirect()->route('inventory');
    }

    public function delete_group(Request $request)
    {
        InventoryGroup::find($request->input('id'))->delete();

        return redirect()->route('inventory');
    }

    public function assign_inventory(Request $request)
    {
        // dd($request->all());
        if(!$request->input('unit') == null && $request->input('component') == null && $request->input('part') == null){
            $unit = Unit::select('code')->where('id', $request->input('unit'))->first();
            // dd($unit->code);
            Inventory::create([
                'installed' => $request->input('installed'),
                'used' => $request->input('used'),
                'reserved' => $request->input('reserved'),
                'ready' => $request->input('ready'),
                'note' => $request->input('note'),
                'item_code' => $unit->code,
                'inventory_group_id' => $request->input('id_group'),
            ]);

            Alert::success('Inventory has Assign to Group', 'Success');
            return redirect()->route('inventory');
        }
        else if(!$request->input('component') == null && $request->input('unit') == null && $request->input('part') == null){
            $component = Component::select('code')->where('id', $request->input('component'))->first();
            // dd($unit->code);
            Inventory::create([
                'installed' => $request->input('installed'),
                'used' => $request->input('used'),
                'reserved' => $request->input('reserved'),
                'ready' => $request->input('ready'),
                'note' => $request->input('note'),
                'item_code' => $component->code,
                'inventory_group_id' => $request->input('id_group'),
            ]);

            Alert::success('Inventory has Assign to Group', 'Success');
            return redirect()->route('inventory');
        }
        else if(!$request->input('part') == null && $request->input('component') == null && $request->input('unit') == null){
            $part = Part::select('code')->where('id', $request->input('part'))->first();
            // dd($unit->code);
            Inventory::create([
                'installed' => $request->input('installed'),
                'used' => $request->input('used'),
                'reserved' => $request->input('reserved'),
                'ready' => $request->input('ready'),
                'note' => $request->input('note'),
                'item_code' => $part->code,
                'inventory_group_id' => $request->input('id_group'),
            ]);

            Alert::success('Inventory has Assign to Group', 'Success');
            return redirect()->route('inventory');
        }
        $group = Group::where('kode', $request->input('group'))->first();
        if (is_null($request->input('group'))) {
            Alert::error('You Not Choose Inventory', 'Failed');
            return redirect()->route('inventory');
        }

        InventoryStock::create([
            'id_group' => $request->input('id_group'),
            'id_item' => $request->input('group'),
            'installed' => $request->input('installed'),
            'used' => $request->input('used'),
            'reserved' => $request->input('reserved'),
            'ready' => $request->input('ready')
        ]);

        // dd($group, $request->all());
        $group->group_inventory = $request->input('id_group');
        // $group->qty = $request->input('qty');
        $group->save();


    }

    public function list_inventory(Request $request)
    {
        $data = Inventory::with('part')->find($request->input('id'));
        // dd($data);
        return $data;
    }

    public function edit_inventory(Request $request)
    {
        $id_item = $request->input('id_item');
        $installed = $request->input('installed');
        $used = $request->input('used');
        $reserved = $request->input('reserved');
        $ready = $request->input('ready');
        $note = $request->input('note');
        $id_group = $request->input('id_group');

        // dd($id_item, $installed, $used, $reserved, $ready);

        for ($i = 0; $i < count($id_item); $i++) {
            $data = Inventory::where('inventory_group_id', $id_group)->where('item_code', $id_item[$i])->first();
            $data->update([
                'installed' => $installed[$i],
                'used' => $used[$i],
                'reserved' => $reserved[$i],
                'ready' => $ready[$i],
                'note' => $note[$i],
            ]);
        }
        Alert::success('Inventory has Updated', 'Success');
        return redirect()->route('inventory');
    }
}
