<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MainGroup;
use App\Models\Group;
use App\Models\SubGroup;
use App\Models\Unit;
use App\Models\Component;
use App\Models\Part;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;
use Image;

class GroupController extends Controller
{
    public function index()
    {
        return view('pages.admin.group');
    }

    public function create_group(Request $request)
    {
        // dd($request->all());
        if (is_null($request->input('choose'))){
            Alert::error('Choose field Must Be Selected', 'Failed');
            return redirect()->route('group');
        }

        if($request->input('choose') == 'main_group'){
            // dd($request->all());

            $name = $request->input('main_group');

            for($i = 0 ; $i < count($request->input('main_group')) ; $i++){
                MainGroup::create([
                    'code' => $this->codeMainGroup(),
                    'name' => $name[$i]
                ]);
            };

            Alert::success('Main Group has been created', 'Success');
            return redirect()->route('group');

        }

        else if($request->input('choose') == 'group'){
            // dd($request->all());
            $spek = '<p><br></p>';
            if (in_array($spek, $request->spek)){
                Alert::error('All Specification field Must Be Filled', 'Failed');
                return redirect()->route('group');
            }
            // dd($request->all());


            $idMainGroup = $request->input('idMainGroup');
            $name = $request->input('group');
            $spek = $request->input('spek');
            // dd($kode1,$kode2,$kode3,$kode4,$kode5,$kode6,);

            for($i = 0 ; $i < count($request->input('group')) ; $i++){
                Group::create([
                    'name' => $name[$i],
                    'code' => $this->codeGroup(),
                    'specification' => $spek[$i],
                    'main_group_id' => $idMainGroup
                ]);
            };

            Alert::success('Group has been created', 'Success');
            return redirect()->route('group');
        }

        else if($request->input('choose') == 'sub_group'){
            // dd($request->all());
            $spek = '<p><br></p>';

            if (in_array($spek, $request->spek)){
                Alert::error('All Specification field Must Be Filled', 'Failed');
                return redirect()->route('group');
            }
            // dd($request->all());
            $name = $request->input('sub_group');
            $spek = $request->input('spek');
            $idGroup = $request->input('idGroup');
            // dd($kodeMainGroup,$kodeGroup,$kodeSubGroup,$kodeUnit,$kodeComponent,$kodePart,);

            for($i = 0 ; $i < count($request->input('sub_group')) ; $i++){
                SubGroup::create([
                    'name' => $name[$i],
                    'code' => $this->codeSubGroup(),
                    'specification' => $spek[$i],
                    'group_id' => $idGroup
                ]);
            };

            Alert::success('Sub Group has been created', 'Success');
            return redirect()->route('group');
        }

        else if($request->input('choose') == 'unit'){
            // dd($request->all());
            // dd($request->file('images'));
            $spek = '<p><br></p>';
            if (in_array($spek, $request->spek)){
                Alert::error('All Specification field Must Be Filled', 'Failed');
                return redirect()->route('group');
            }

            $validator= Validator::make($request->all(),[
                            'images.*' => 'mimes:jpg,jpeg,png|max:2048'
                        ]);

            if($validator->fails()){
                $error = $validator->messages()->get('*');
                // dd($error);
                Alert::error('Images must be a file of type: jpg, jpeg, png. Or Images must not be greater than 2000 kilobytes.', 'Failed');
                return redirect()->route('group');
            }

            $idSubGroup = $request->input('idSubGroup');
            $name = $request->input('unit');
            $maker = $request->input('maker');
            $partNumber = $request->input('part-number');
            $serialNumber = $request->input('serial-number');
            $spek = $request->input('spek');

            if($request->hasFile('images')){
                $files = [];
                foreach ($request->file('images') as $file) {
                    if ($file->isValid()) {
                        $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                        // $file->move(public_path('img'), $filename);
                        $destinationPath = public_path('img');
                        // $input['file'] = time().'.'.$file->getClientOriginalExtension();
                        $imgFile = Image::make($file->getRealPath());
                        $imgFile->resize(500, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename);
                        $files[] = [
                            'filename' => $filename,
                        ];
                    }
                }
            }

            // dd($files);

            for($i = 0 ; $i < count($request->input('unit')) ; $i++){
                Unit::create([
                    'code' => $this->codeUnit(),
                    'name' => $name[$i],
                    'specification' => $spek[$i],
                    'maker' => $maker[$i],
                    'part_number' => $partNumber[$i],
                    'serial_number' => $serialNumber[$i],
                    'sub_group_id' => $idSubGroup,
                    'images' => (array_key_exists($i,$request->file('images')) ? $files[$i]['filename'] : null ),
                ]);
            };



            Alert::success('Unit has been created', 'Success');
            return redirect()->route('group');
            // dd($kode5);
        }

        else if($request->input('choose') == 'component'){
            // dd($request->all());
            $spek = '<p><br></p>';
            if (in_array($spek, $request->spek)){
                Alert::error('All Specification field Must Be Filled', 'Failed');
                return redirect()->route('group');
            }

            $validator= Validator::make($request->all(),[
                'images.*' => 'mimes:jpg,jpeg,png|max:2048'
            ]);

            if($validator->fails()){
                $error = $validator->messages()->get('*');
                // dd($error);
                Alert::error('Images must be a file of type: jpg, jpeg, png. Or Images must not be greater than 2000 kilobytes.', 'Failed');
                return redirect()->route('group');
            }

            if($request->hasFile('images')){
                $files = [];
                foreach ($request->file('images') as $file) {
                    if ($file->isValid()) {
                        $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                        // $file->move(public_path('img'), $filename);
                        $destinationPath = public_path('img');
                        // $input['file'] = time().'.'.$file->getClientOriginalExtension();
                        $imgFile = Image::make($file->getRealPath());
                        $imgFile->resize(500, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename);
                        $files[] = [
                            'filename' => $filename,
                        ];
                    }
                }
            }

            $idUnit = $request->input('idUnit');
            $name = $request->input('component');
            $maker = $request->input('maker');
            $partNumber = $request->input('part-number');
            $serialNumber = $request->input('serial-number');
            $spek = $request->input('spek');
            // dd($kodeMainGroup,$kodeGroup,$kodeSubGroup,$kodeUnit,$kodeComponent,$kodePart,);

            for($i = 0 ; $i < count($request->input('component')) ; $i++){
                Component::create([
                    'code' => $this->codeComponent(),
                    'name' => $name[$i],
                    'specification' => $spek[$i],
                    'maker' => $maker[$i],
                    'part_number' => $partNumber[$i],
                    'serial_number' => $serialNumber[$i],
                    'unit_id' => $idUnit,
                    'images' => (array_key_exists($i,$request->file('images')) ? $files[$i]['filename'] : null ),
                ]);
            };

            Alert::success('Component has been created', 'Success');
            return redirect()->route('group');

        }

        elseif ($request->input('choose') == 'part'){
            // dd($request->all());
            $spek = '<p><br></p>';
            if (in_array($spek, $request->spek)){
                Alert::error('All Specification field Must Be Filled', 'Failed');
                return redirect()->route('group');
            }

            $validator= Validator::make($request->all(),[
                'images.*' => 'mimes:jpg,jpeg,png|max:2048'
            ]);

            if($validator->fails()){
                $error = $validator->messages()->get('*');
                // dd($error);
                Alert::error('Images must be a file of type: jpg, jpeg, png. Or Images must not be greater than 2000 kilobytes.', 'Failed');
                return redirect()->route('group');
            }

            if($request->hasFile('images')){
                $files = [];
                foreach ($request->file('images') as $file) {
                    if ($file->isValid()) {
                        $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                        // $file->move(public_path('img'), $filename);
                        $destinationPath = public_path('img');
                        // $input['file'] = time().'.'.$file->getClientOriginalExtension();
                        $imgFile = Image::make($file->getRealPath());
                        $imgFile->resize(500, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename);
                        $files[] = [
                            'filename' => $filename,
                        ];
                    }
                }
            }

            $idComponent = $request->input('idComponent');
            $name = $request->input('part');
            $maker = $request->input('maker');
            $partNumber = $request->input('part-number');
            $serialNumber = $request->input('serial-number');
            $spek = $request->input('spek');
            // dd($kodeMainGroup,$kodeGroup,$kodeSubGroup,$kodeUnit,$kodeComponent,$kodePart,);

            for($i = 0 ; $i < count($request->input('part')) ; $i++){
                Part::create([
                    'code' => $this->codePart(),
                    'name' => $name[$i],
                    'specification' => $spek[$i],
                    'maker' => $maker[$i],
                    'part_number' => $partNumber[$i],
                    'serial_number' => $serialNumber[$i],
                    'component_id' => $idComponent,
                    'images' => (array_key_exists($i,$request->file('images')) ? $files[$i]['filename'] : null ),
                ]);
            };

            Alert::success('Part has been created', 'Success');
            return redirect()->route('group');
        }
    }

    public function delete($code)
    {

        // dd($kode);
        if (strlen($code) == 1){

            $data = MainGroup::where('code', $code)->first();

            $dataSubGroup = SubGroup::whereHas('group', function($q) use($code){
                $q->whereHas('main_group', function($qu) use($code){
                    $qu->where('code', $code);
                });
            });

            $dataUnit = Unit::whereHas('sub_group', function($q) use($code){
                $q->whereHas('group', function($qu) use($code){
                    $qu->whereHas('main_group', function($que) use($code){
                        $que->where('code', $code);
                    });
                });
            });

            $dataComponent = Component::whereHas('unit', function($q) use($code){
                $q->whereHas('sub_group', function($qu) use($code){
                    $qu->whereHas('group', function($que) use($code){
                        $que->whereHas('main_group', function($quer) use($code){
                            $quer->where('code', $code);
                        });
                    });
                });
            })->get();

            $dataPart = Part::whereHas('component', function($q) use($code){
                $q->whereHas('unit', function($qu) use($code){
                    $qu->whereHas('sub_group', function($que) use($code){
                        $que->whereHas('group', function($quer) use($code){
                            $quer->whereHas('main_group', function($query) use($code){
                                $query->where('code', $code);
                            });
                        });
                    });
                });
            })->get();

            if(!$dataPart->isEmpty()){
                $dataPart->each->delete();
            }
            if(!$dataComponent->isEmpty()){
                $dataComponent->each->delete();
            }
            if(!$dataUnit->isEmpty()){
                $dataUnit->each->delete();
            }
            if(!$dataSubGroup->isEmpty()){
                $dataSubGroup->each->delete();
            }
            if(!$data->group->isEmpty()){
                $data->group->each->delete();
            }

            $data->delete();

            Alert::success('Delete Success', 'Success');
            return redirect()->route('group');
        }

        elseif (strlen($code) == 2){

            $data = Group::where('code', $code)->first();

            $dataUnit = Unit::whereHas('sub_group', function($q) use($code){
                $q->whereHas('group', function($qu) use($code){
                    $qu->where('code', $code);
                });
            })->get();

            $dataComponent = Component::whereHas('unit', function($q) use($code){
                $q->whereHas('sub_group', function($qu) use($code){
                    $qu->whereHas('group', function($que) use($code){
                        $que->where('code', $code);
                    });
                });
            })->get();

            $dataPart = Part::whereHas('component', function($q) use($code){
                $q->whereHas('unit', function($qu) use($code){
                    $qu->whereHas('sub_group', function($que) use($code){
                        $que->whereHas('group', function($quer) use($code){
                            $quer->where('code', $code);
                        });
                    });
                });
            })->get();

            if(!$dataPart->isEmpty()){
                $dataPart->each->delete();
            }
            if(!$dataComponent->isEmpty()){
                $dataComponent->each->delete();
            }
            if(!$dataUnit->isEmpty()){
                $dataUnit->each->delete();
            }
            if(!$data->sub_group->isEmpty()){
                $data->sub_group->each->delete();
            }

            $data->delete();
            Alert::success('Delete Success', 'Success');
            return redirect()->route('group');
        }

        elseif (strlen($code) == 3){
            $data = SubGroup::where('code', $code)->first();

            $dataComponent = Component::whereHas('unit', function($q) use($code){
                $q->whereHas('sub_group', function($qu) use($code){
                    $qu->where('code', $code);
                });
            })->get();

            $dataPart = Part::whereHas('component', function($q) use($code){
                $q->whereHas('unit', function($qu) use($code){
                    $qu->whereHas('sub_group', function($que) use($code){
                        $que->where('code', $code);
                    });
                });
            })->get();

            if(!$dataPart->isEmpty()){
                $dataPart->each->delete();
            }
            if(!$dataComponent->isEmpty()){
                $dataComponent->each->delete();
            }
            if(!$data->unit->isEmpty()){
                $data->unit->each->delete();
            }

            $data->delete();

            Alert::success('Delete Success', 'Success');
            return redirect()->route('group');
        }

        elseif (strlen($code) == 6){
            $data = Unit::where('code', $code)->first();

            $dataPart = Part::whereHas('component', function($q) use($code){
                $q->whereHas('unit', function($query) use($code){
                    $query->where('code', $code);
                });
            })->get();

            if(!$dataPart->isEmpty()){
                foreach($dataPart as $part){
                    unlink("img/".$part->images);
                }
                $dataPart->each->delete();
            }
            if(!$data->component->isEmpty()){
                foreach($data->component as $component){
                    unlink("img/".$component->images);
                }
                $data->component->each->delete();
            }
            unlink("img/".$data->images);
            $data->delete();


            Alert::success('Delete Unit ' .$code. ' Success', 'Success');
            return redirect()->route('group');

        }

        elseif (strlen($code) == 9){
            $data = Component::where('code', $code)->first();
            // dd($data, $data->part);
            if(!$data->part->isEmpty()){
                foreach($data->part as $part){
                    unlink("img/".$part->images);
                }
                $data->part->each->delete();
            }
            unlink("img/".$data->images);
            $data->delete();

            Alert::success('Delete Component ' .$code. ' Success', 'Success');
            return redirect()->route('group');

        }

        else{
            $data = Part::where('code', $code)->first();
            $data->delete();

            unlink("img/".$data->images);

            Alert::success('Delete Part ' .$code. ' Success', 'Success');
            return redirect()->route('group');
        }

    }

    public function detail_unit(Request $request)
    {
        $data = Unit::where('code', $request->input('code'))->first();

        return json_encode($data);
    }

    public function detail_component(Request $request)
    {
        $data = Component::where('code', $request->input('code'))->first();

        return json_encode($data);
    }

    public function detail_part(Request $request)
    {
        $data = Part::where('code', $request->input('code'))->first();

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
        $unit = Unit::where('code', $request->input('kode'))->first();
        $unit->maker = $request->input('maker');
        $unit->part_number = $request->input('part_number');
        $unit->serial_number = $request->input('serial_number');
        $unit->specification = $request->input('spek');

        $unit->save();
        Alert::success('Berhasil', 'Data Berhasil di Ubah');

        return redirect()->to('/admin/group');
    }

    public function update_component(Request $request)
    {
        $component = Component::where('code', $request->input('kode'))->first();
        $component->maker = $request->input('maker');
        $component->part_number = $request->input('part_number');
        $component->serial_number = $request->input('serial_number');
        $component->specification = $request->input('spek');

        $component->save();
        Alert::success('Berhasil', 'Data Berhasil di Ubah');

        return redirect()->to('/admin/group');
    }

    public function update_part(Request $request)
    {
        $part = Part::where('code', $request->input('kode'))->first();
        $part->maker = $request->input('maker');
        $part->part_number = $request->input('part_number');
        $part->serial_number = $request->input('serial_number');
        $part->specification = $request->input('spek');

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
        $group_name = SubGroup::select('code', 'name')->where('code', $kode)->first();
        return $group_name->name;
    }

    public function codeMainGroup($length = 1)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        $check = MainGroup::where('code', $randomString)->exists();
        if($check){
            return $this->codeMainGroup();
        }
        return $randomString;
    }
    public function codeGroup($length = 2)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        $check = Group::where('code', $randomString)->exists();
        if($check){
            return $this->codeGroup();
        }
        return $randomString;
    }
    public function codeSubGroup($length = 3)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        $check = SubGroup::where('code', $randomString)->exists();
        if($check){
            return $this->codeSubGroup();
        }
        return $randomString;
    }
    public function codeUnit($length = 6)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        $check = Unit::where('code', $randomString)->exists();
        if($check){
            return $this->codeUnit();
        }
        return $randomString;
    }
    public function codeComponent($length = 9)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        $check = Component::where('code', $randomString)->exists();
        if($check){
            return $this->codeComponent();
        }
        return $randomString;
    }
    public function codePart($length = 12)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        $check = Part::where('code', $randomString)->exists();
        if($check){
            return $this->codePart();
        }
        return $randomString;
    }
}
