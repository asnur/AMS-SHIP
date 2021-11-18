<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\InventoryGroup;
use App\Models\InventoryStock;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory_group = InventoryGroup::all();
        $main_group = DB::table('group')->select('name', 'kode')->whereRaw('LENGTH(kode) = 1')->get();
        $group = DB::table('group')->select('name', 'kode', 'kode1')->whereRaw('LENGTH(kode) = 2')->get();
        $sub_group = DB::table('group')->select('name', 'kode', 'kode2')->whereRaw('LENGTH(kode) = 3')->get();
        $unit = DB::table('group')->select('name', 'kode', 'kode3')->whereRaw('LENGTH(kode) = 6')->get();
        $component = DB::table('group')->select('name', 'kode', 'kode4')->whereRaw('LENGTH(kode) = 9')->get();
        $part = DB::table('group')->select('name', 'kode', 'kode5')->whereRaw('LENGTH(kode) = 12')->get();
        $all_inventory = DB::table('group')->select('name', 'kode')->whereRaw('LENGTH(kode) >= 6')->get();
        // dd($all_inventory);
        return view('pages/admin/inventory', compact(['inventory_group', 'main_group', 'group', 'sub_group', 'unit', 'component', 'part', 'all_inventory']));
    }

    public function all_inventory()
    {
        $all_inventory = DB::table('group')->select('name', 'kode', 'id_item', 'installed', 'used', 'reserved', 'ready')->leftJoin('inventory_stock', 'group.kode', '=', 'inventory_stock.id_item')->whereRaw('LENGTH(kode) >= 6')->get();

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

        Alert::success('Inventory has Assign to Group', 'Success');
        return redirect()->route('inventory');
    }

    public function list_inventory(Request $request)
    {
        $data = InventoryStock::with('group')->where('id_group', $request->input('id_group'))->get();
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
            $data = InventoryStock::where('id_group', $id_group)->where('id_item', $id_item[$i])->first();
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
