<?php
$no = 1;
?>
<div>

    <div>
        <div class="container-fluid">

         <!-- Page Heading -->
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
             <h1 class="h3 mb-0 text-gray-800">Main Group</h1>
             <div class="text-right">
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal"
                    data-target="#create"><i class="fas fa-plus fa-sm text-white-50"></i> Create </a>
            </div>
             {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
         </div>
         {{-- {{ dd($group)}}
         {{ dd($group[1]->kode) }} --}}
         {{-- {{dd($main_group)}} --}}
         <!-- Content Row -->
         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <div class="row">
                             <div class="col-12 mb-3" wire:ignore>
                                 <label class="font-weight-bold">Main Group</label>
                                 <select class="form-control" id="main_group_list">
                                     <option> --- Choose Main Group --- </option>
                                     @foreach ($main_group as $mg)
                                         <option value="{{ $mg->id }}">{{ $mg->code }}-{{ $mg->name }}
                                         </option>
                                     @endforeach
                                 </select><br>
                             </div>
                             {{-- {{ $kode1 }} --}}
                             <div class="col-3" wire:ignore>
                                 <label class="font-weight-bold">Group</label>
                                 <select class="form-control" id="group_list">
                                    <option value=""> --- Choose Group --- </option>
                                 </select>
                             </div>
                             <div class="col-3" wire:ignore>
                                 <label class="font-weight-bold">Sub Group</label>
                                 <select class="form-control" id="sub_group_list">
                                    <option value=""> --- Choose Sub Group --- </option>
                                 </select>
                             </div>
                             <div class="col-3" wire:ignore>
                                 <label class="font-weight-bold">Unit</label>
                                 <select class="form-control" id="unit_list">
                                    <option value=""> --- Choose Unit --- </option>
                                 </select>
                             </div>
                             <div class="col-3" wire:ignore>
                                 <label class="font-weight-bold">Component</label>
                                 <select class="form-control" id="component_list">
                                    <option value=""> --- Choose Component --- </option>
                                 </select>
                             </div>
                             <div class="col-12 text-right mt-5">
                                 <a class="btn btn-success" id="filter"><i class="fa fa-filter"></i> Detail</a>
                             </div>
                             <div class="col-12 mt-5 data-main-group">
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </div>

        <form action="/admin/createGroup" method="POST" enctype="multipart/form-data">
            @csrf
            <div wire:ignore class="modal fade" id="create" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body" id="modal">
                            <div class="container">
                                <div class="row append">
                                    <div class="col-12" wire:ignore>
                                        <label class="font-weight-bold">Create Choose</label>
                                        <select id="chooseCreate" name="choose" class="form-control" style="width: 100% !important" required>
                                            <option value=""> --- Choose --- </option>
                                            <option value="main_group">Main Group</option>
                                            <option value="group">Group</option>
                                            <option value="sub_group">Sub Group</option>
                                            <option value="unit">Unit</option>
                                            <option value="component">Component</option>
                                            <option value="part">Part</option>
                                        </select><br>
                                    </div>

                                    <div class="col-12 chooseMainGroup" >
                                        <label class="font-weight-bold">Main Group</label>
                                        <select class="form-control" name="idMainGroup" id="create_main_group_list" style="width: 100% !important" wire:ignore>
                                            <option value=""> --- Choose Main Group --- </option>
                                            @foreach ($main_group as $mg)
                                                <option value="{{ $mg->id }}">{{ $mg->code }}-{{ $mg->name }}
                                                </option>
                                            @endforeach
                                        </select><br>
                                    </div>
                                    <div class="col-6 chooseGroup mb-3" wire:ignore>
                                        <label class="font-weight-bold">Group</label>
                                        <select class="form-control" name="idGroup" id="create_group_list" style="width: 100% !important">
                                           <option value=""> --- Choose Group --- </option>
                                        </select>
                                    </div>
                                    <div class="col-6 chooseSubGroup mb-3" wire:ignore>
                                        <label class="font-weight-bold">Sub Group</label>
                                        <select class="form-control" name="idSubGroup" id="create_sub_group_list" style="width: 100% !important">
                                           <option value=""> --- Choose Sub Group --- </option>
                                        </select>
                                    </div>
                                    <div class="col-6 chooseUnit mb-3" wire:ignore>
                                        <label class="font-weight-bold">Unit</label>
                                        <select class="form-control" name="idUnit" id="create_unit_list" style="width: 100% !important">
                                           <option value=""> --- Choose Unit --- </option>
                                        </select>
                                    </div>
                                    <div class="col-6 chooseComponent mb-3" wire:ignore>
                                        <label class="font-weight-bold">Component</label>
                                        <select class="form-control" name="idComponent" id="create_component_list" style="width: 100% !important">
                                           <option value=""> --- Choose Component --- </option>
                                        </select>
                                    </div>

                                    <div class="col-12 createMainGroup">
                                        <label class="font-weight-bold">Main Group</label>
                                        <button id="addMainGroup" type="button" class="btn btn-outline-primary"><i class="fa fa-plus" aria-hidden="true"> </i>Tambah</button>
                                        <button id="removeMainGroup" type="button" class="btn btn-outline-danger"><i class="fa fa-minus" aria-hidden="true"> </i>Remove</button>
                                        <input type="text" class="form-control mt-2" placeholder="Input Main Group Name" name="main_group[]">
                                    </div>

                                    <div class="col-12 createGroup" >
                                        <label class="font-weight-bold">Group</label>
                                        <button id="addGroup" type="button" class="btn btn-outline-primary"><i class="fa fa-plus" aria-hidden="true"> </i>Tambah</button>
                                        <button id="removeGroup" type="button" class="btn btn-outline-danger"><i class="fa fa-minus" aria-hidden="true"> </i>Remove</button>
                                            <input type="text" class="form-control mt-2" placeholder="Input Group Name" name="group[]">
                                    </div>

                                    <div class="col-12 createSubGroup">
                                        <label class="font-weight-bold">Sub Group </label>
                                        <button id="addSubGroup" type="button" class="btn btn-outline-primary"><i class="fa fa-plus" aria-hidden="true"> </i>Tambah</button>
                                        <button id="removeSubGroup" type="button" class="btn btn-outline-danger"><i class="fa fa-minus" aria-hidden="true"> </i>Remove</button>
                                        <input type="text" placeholder="Input Sub Group Name" name="sub_group[]" class="form-control mt-2">
                                    </div>

                                    <div class="col-12 createUnit">
                                        <label class="font-weight-bold">Unit</label>
                                        <button id="addUnit" type="button" class="btn btn-outline-primary"><i class="fa fa-plus" aria-hidden="true"> </i>Tambah</button>
                                        <button id="removeUnit" type="button" class="btn btn-outline-danger"><i class="fa fa-minus" aria-hidden="true"> </i>Remove</button>
                                        <input type="text" class="form-control mt-2" placeholder="Input Unit Name" name="unit[]">
                                    </div>

                                    <div class="col-12 createComponent">
                                        <label class="font-weight-bold">Component</label>
                                        <button id="addComponent" type="button" class="btn btn-outline-primary"><i class="fa fa-plus" aria-hidden="true"> </i>Tambah</button>
                                        <button id="removeComponent" type="button" class="btn btn-outline-danger"><i class="fa fa-minus" aria-hidden="true"> </i>Remove</button>
                                        <input type="text" class="form-control mt-2" placeholder="Input Component Name" name="component[]">
                                    </div>

                                    <div class="col-12 createPart">
                                        <label class="font-weight-bold">Part</label>
                                        <button id="addPart" type="button" class="btn btn-outline-primary"><i class="fa fa-plus" aria-hidden="true"> </i>Add</button>
                                        <button id="removePart" type="button" class="btn btn-outline-danger"><i class="fa fa-minus" aria-hidden="true"> </i>Remove</button>
                                        <input type="text" class="form-control mt-2" placeholder="Input Part Name" name="part[]">
                                    </div>

                                    <div class="col-12 maker">
                                        <label class="font-weight-bold mt-3">Maker</label>
                                        <input type="text" class="form-control mt-2" placeholder="Input Maker" name="maker[]">
                                    </div>
                                    <div class="col-6 serial_number">
                                        <label class="font-weight-bold mt-3">Serial Number</label>
                                        <input type="text" class="form-control mt-2" placeholder="Input Serial Number" name="serial-number[]">
                                    </div>
                                    <div class="col-6 part_number">
                                        <label class="font-weight-bold mt-3">Part Number</label>
                                        <input type="text" class="form-control mt-2" placeholder="Input Part Number" name="part-number[]">
                                    </div>
                                    <div class="col-12 specification">
                                        <label class="font-weight-bold mt-3">Specification</label>
                                        <textarea type="text" class="form-control spek" id="specification" name="spek[]"></textarea>
                                    </div>
                                    <div class="col-12 files">
                                        <label class="font-weight-bold mt-3">Upload Image</label>
                                        <input type="file" class="form-control-file" id="images" name="images[]">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer bg-primary">
                            <button type="submit" class="btn btn-success"><i class="fas fa-plus fa-sm text-white-50"></i> Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
     </div>
</div>

@push('group_inventory')
    <script>
        $('#main_group_list, #group_list, #sub_group_list, #unit_list, #component_list')
            .select2({
                theme: 'bootstrap4',
            });

        $('#group_list, #sub_group_list, #unit_list, #component_list').prop('disabled', true);
        $('.createMainGroup, .createGroup, .createSubGroup, .createUnit, .createComponent, .createPart, .specification, .maker, .serial_number, .part_number, .files').hide();
        $('.chooseMainGroup, .chooseGroup, .chooseSubGroup, .chooseUnit, .chooseComponent').hide();
        //Show Group List
        $('#main_group_list').change(function(e) {
            var data = $('#main_group_list').select2("val");
            // console.log(data);
            Livewire.emit('selectMainGroup', data)

            $(document).on('groupData', event => {
            var data = event.detail.group;
            console.log(data);
                $('#group_list').html('')
                $('#group_list').append('<option value=""> --- Choose Group --- </option>')
                if (data == '') {
                    $('#group_list').prop('disabled', true);
                    $('#sub_group_list').prop('disabled', true);
                    $('#unit_list').prop('disabled', true);
                    $('#component_list').prop('disabled', true);
                } else {
                    $('#group_list').prop('disabled', false);
                    $('#sub_group_list').prop('disabled', true);
                    $('#sub_group_list').html('')
                    $('#sub_group_list').append('<option value=""> --- Choose Sub Group --- </option>')
                    $('unit_list').prop('disabled', true);
                    $('unit_list').html('')
                    $('unit_list').append('<option value=""> --- Choose Unittt --- </option>')
                    $('#component_list').prop('disabled', true);
                    $('#component_list').html('')
                    $('#component_list').append('<option value=""> --- Choose Component --- </option>')
                }
                $.each(data, function() {
                    console.log(this);
                    $('#group_list').append(
                        `<option value="${this.id}">${this.code}-${this.name}</option>`)
                })
            })
        });
        //Show Sub Group List
        $('#group_list').change(function(e) {
            var data = $('#group_list').select2("val");
            Livewire.emit('selectGroup', data)
            // console.log(data);

            $(document).on('subgroupData', event => {
                var data = event.detail.subgroup;
                $('#sub_group_list').html('')
                $('#sub_group_list').append('<option value=""> --- Choose Sub Group --- </option>')
                if (data == '') {
                    $('#sub_group_list').prop('disabled', true);
                    $('#unit_list').prop('disabled', true);
                    $('#component_list').prop('disabled', true);
                    $('#sub_group_list').html('')
                    $('#sub_group_list').append('<option value=""> No Sub Group </option>')
                    $('#component_list').html('')
                    $('#component_list').append('<option value=""> No Component </option>')
                } else {
                    $('#sub_group_list').prop('disabled', false);
                    $('#unit_list').prop('disabled', true);
                    $('#unit_list').html('')
                    $('#unit_list').append('<option value=""> --- Choose Unit --- </option>')
                    $('#component_list').prop('disabled', true);
                    $('#component_list').html('')
                    $('#component_list').append('<option value=""> --- Choose Component --- </option>')
                }
                $.each(data, function() {
                    $('#sub_group_list').append(
                        `<option value="${this.id}">${this.code}-${this.name}</option>`)
                })
            })
        });
        //Show Unit List
        $('#sub_group_list').change(function(e) {
            var data = $('#sub_group_list').select2("val");
            Livewire.emit('selectSubGroup', data)
            // console.log(data);
            $(document).on('unitData', event => {
                var data = event.detail.unit;
                $('#unit_list').html('')
                $('#unit_list').append('<option value=""> --- Choose Unit --- </option>')
                if (data == '') {
                    $('#unit_list').prop('disabled', true);
                    $('#component_list').prop('disabled', true);
                    $('#unit_list').html('')
                    $('#unit_list').append('<option value=""> No Unit </option>')
                    $('#component_list').html('')
                    $('#component_list').append('<option value=""> No Component </option>')
                } else {
                    $('#unit_list').prop('disabled', false);
                    $('#component_list').prop('disabled', true);
                    $('#component_list').html('')
                    $('#component_list').append('<option value=""> --- Choose Component --- </option>')
                }
                $.each(data, function() {
                    $('#unit_list').append(
                        `<option value="${this.id}">${this.code}-${this.name}</option>`)
                })
            })
        });
        //Show Component List
        $('#unit_list').change(function(e) {
            var data = $('#unit_list').select2("val");
            // console.log(data);
            Livewire.emit('selectUnit', data)
            $(document).on('componentData', event => {
                var data = event.detail.component;
                $('#component_list').html('')
                $('#component_list').append('<option value=""> --- Choose Component --- </option>')
                if (data == '') {
                    $('#component_list').prop('disabled', true);
                    $('#component_list').html('')
                    $('#component_list').append('<option value=""> No Component </option>')
                } else {
                    $('#component_list').prop('disabled', false);
                }
                $.each(data, function() {
                    $('#component_list').append(
                        `<option value="${this.id}">${this.code}-${this.name}</option>`)
                })
            })
        });
        //Detail
        $('#filter').on('click', function() {
            var main_group = $("#main_group_list").val();
            var group = $("#group_list").val();
            var sub_group = $("#sub_group_list").val();
            var unit = $("#unit_list").val();
            var component = $("#component_list").val();
            var part = $("#part_list").val();
            var data = {
                'main_group': main_group,
                'group': group,
                'sub_group': sub_group,
                'unit': unit,
                'component': component,
                'part': part
            };

            console.log(main_group, group, sub_group, unit, component, part);

            Livewire.emit('detailGrup', data)
            $(document).on('detailGrupData', event => {
                var sub_group_data = event.detail.sub_group;
                var group_data = event.detail.group;
                var unit_data = event.detail.unit;
                var component_data = event.detail.component;
                var part_data = event.detail.part;

                var data_group = '';
                var data_sub_group = '';
                var data_unit = '';
                var data_component = '';
                var data_part = '';

                    $.each(group_data, function(i, obj) {
                        data_group += `
                            <tr>
                                    <td>${i+1}</td>
                                    <td>${obj.code}</td>
                                    <td>${obj.name}</td>
                                    <td>${obj.specification}</td>
                                    <td>
                                        @if (auth()->user()->can('delete management group'))
                                        <a class="btn btn-sm btn-danger"  href="/admin/delete/${obj.code}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            `;
                    });

                    $.each(sub_group_data, function(i, obj) {
                        data_sub_group += `
                            <tr>
                                    <td>${i+1}</td>
                                    <td>${obj.code}</td>
                                    <td>${obj.name}</td>
                                    <td>${obj.specification}</td>
                                    <td>
                                        @if (auth()->user()->can('delete management group'))
                                        <a class="btn btn-sm btn-danger"  href="/admin/delete/${obj.code}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            `;
                    });

                    $.each(unit_data, function(i, obj) {
                        data_unit += `
                            <tr>
                                    <td>${i+1}</td>
                                    <td>${obj.code}</td>
                                    <td>${obj.name}</td>
                                    <td>${obj.maker}</td>
                                    <td>${obj.part_number}</td>
                                    <td>${obj.serial_number}</td>
                                    <td>${obj.specification}</td>
                                    <td><img src="{{asset('/img/${obj.images}')}}" alt="No Image" height="50" class="img-thumbnail"></td>
                                    <td>
                                        <span data-toggle="tooltip" data-placement="bottom" title="Edit">
                                            <a class="btn btn-sm btn-primary" onclick="editUnit(${obj.code})" data-toggle="modal" data-target="#editUnit"><i class="fa fa-edit"></i></a>
                                        </span>
                                        @if (auth()->user()->can('delete management group'))
                                        <a class="btn btn-sm btn-danger"  href="/admin/delete/${obj.code}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            `;

                    });

                    $.each(component_data, function(i, obj) {
                        data_component += `
                            <tr>
                                    <td>${i+1}</td>
                                    <td>${obj.code}</td>
                                    <td>${obj.name}</td>
                                    <td>${obj.maker}</td>
                                    <td>${obj.part_number}</td>
                                    <td>${obj.serial_number}</td>
                                    <td>${obj.specification}</td>
                                    <td><img src="{{asset('/img/${obj.images}')}}" alt="No Image" height="50" class="img-thumbnail"></td>
                                    <td>
                                        <span data-toggle="tooltip" data-placement="bottom" title="Edit">
                                            <a class="btn btn-sm btn-primary" onclick="editComponent(${obj.code})" data-toggle="modal" data-target="#editComponent"><i class="fa fa-edit"></i></a>
                                        </span>
                                        @if (auth()->user()->can('delete management group'))
                                            <a class="btn btn-sm btn-danger"  href="/admin/delete/${obj.code}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            `;
                    });
                    $.each(part_data, function(i, obj) {
                        data_part += `
                            <tr>
                                    <td>${i+1}</td>
                                    <td>${obj.code}</td>
                                    <td>${obj.name}</td>
                                    <td>${obj.maker}</td>
                                    <td>${obj.part_number}</td>
                                    <td>${obj.serial_number}</td>
                                    <td>${obj.specification}</td>
                                    <td><img src="{{asset('/img/${obj.images}')}}" alt="No Image" height="50" class="img-thumbnail"></td>
                                    <td>
                                        <span data-toggle="tooltip" data-placement="bottom" title="Edit">
                                            <a class="btn btn-sm btn-primary" onclick="editPart(${obj.code})" data-toggle="modal" data-target="#editPart"><i class="fa fa-edit"></i></a>
                                        </span>
                                        <a class="btn btn-sm btn-warning text-white" href="/admin/detail-sub-part/${obj.code}" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-eye"></i></a>
                                        @if (auth()->user()->can('delete management group'))
                                            <a class="btn btn-sm btn-danger"  href="/admin/delete/${obj.code}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            `;
                    });


                    const html =
                        `
                        <form action="/admin/updateUnit" method="POST">
                        @csrf
                        <div class="modal fade bd-example-modal-lg" id="editUnit" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h4>Edit Unit</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="font-weight-bold">Code</label>
                                                <input type="text" readonly class="form-control" name="kode" id="kode_unit">
                                            </div>
                                            <div class="col-12">
                                                <label class="font-weight-bold mt-3">Name</label>
                                                <input type="text" readonly class="form-control" name="nama" id="nama_unit">
                                            </div>
                                            <div class="col-12 image_unit">
                                            </div>
                                            <div class="col-12">
                                                <label class="font-weight-bold mt-3">Maker</label>
                                                <input type="text" readonly class="form-control" name="maker" id="maker_unit">
                                            </div>
                                            <div class="col-6">
                                                <label class="font-weight-bold mt-3">Part Number</label>
                                                <input type="text" readonly class="form-control" name="part_number" id="part_number_unit">
                                            </div>
                                            <div class="col-6">
                                                <label class="font-weight-bold mt-3">Serial Number</label>
                                                <input type="text" readonly class="form-control" name="serial_number" id="serial_number_unit">
                                            </div>
                                            <div class="col-12">
                                                <label class="font-weight-bold mt-3">Spesification</label>
                                                <textarea type="text" class="form-control" id="spek_unit" name="spek"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-primary">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Kirim</button>
                                </div>
                            </div>
                        </div>
                        </div>
                        </form>

                        <form action="/admin/updateComponent" method="POST">
                        @csrf
                        <div class="modal fade bd-example-modal-lg" id="editComponent" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h4>Edit Component</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="font-weight-bold">Code</label>
                                                <input type="text" readonly class="form-control" name="kode" id="kode_component">
                                            </div>
                                            <div class="col-12">
                                                <label class="font-weight-bold mt-3">Name</label>
                                                <input type="text" readonly class="form-control" name="nama" id="nama_component">
                                            </div>
                                            <div class="col-12 image_component">
                                            </div>
                                            <div class="col-12">
                                                <label class="font-weight-bold mt-3">Maker</label>
                                                <input type="text" readonly class="form-control" name="maker" id="maker_component">
                                            </div>
                                            <div class="col-6">
                                                <label class="font-weight-bold mt-3">Part Number</label>
                                                <input type="text" readonly class="form-control" name="part_number" id="part_number_component">
                                            </div>
                                            <div class="col-6">
                                                <label class="font-weight-bold mt-3">Serial Number</label>
                                                <input type="text" readonly class="form-control" name="serial_number" id="serial_number_component">
                                            </div>
                                            <div class="col-12">
                                                <label class="font-weight-bold mt-3">Spesification</label>
                                                <textarea type="text" class="form-control" id="spek_component" name="spek"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-primary">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Kirim</button>
                                </div>
                            </div>
                        </div>
                        </div>
                        </form>

                        <form action="/admin/updatePart" method="POST">
                        @csrf
                        <div class="modal fade bd-example-modal-lg" id="editPart" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h4>Edit Part</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="font-weight-bold">Code</label>
                                                <input type="text" readonly class="form-control" name="kode" id="kode_part">
                                            </div>
                                            <div class="col-12">
                                                <label class="font-weight-bold mt-3">Name</label>
                                                <input type="text" readonly class="form-control" name="nama" id="nama_part">
                                            </div>
                                            <div class="col-12 image_part">
                                            </div>
                                            <div class="col-12">
                                                <label class="font-weight-bold mt-3">Maker</label>
                                                <input type="text" readonly class="form-control" name="maker" id="maker_part">
                                            </div>
                                            <div class="col-6">
                                                <label class="font-weight-bold mt-3">Part Number</label>
                                                <input type="text" readonly class="form-control" name="part_number" id="part_number_part">
                                            </div>
                                            <div class="col-6">
                                                <label class="font-weight-bold mt-3">Serial Number</label>
                                                <input type="text" readonly class="form-control" name="serial_number" id="serial_number_part">
                                            </div>
                                            <div class="col-12">
                                                <label class="font-weight-bold mt-3">Spesification</label>
                                                <textarea type="text" class="form-control" id="spek_part" name="spek"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-primary">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Kirim</button>
                                </div>
                            </div>
                        </div>
                        </div>
                        </form>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link text-primary font-weight-bold active" id="profile-tab" data-toggle="tab" href="#group"
                                role="tab" aria-controls="profile" aria-selected="false">Group</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary font-weight-bold" id="profile-tab" data-toggle="tab" href="#subgroup" role="tab"
                                aria-controls="profile" aria-selected="false">Sub Group</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary font-weight-bold" id="contact-tab" data-toggle="tab" href="#unit" role="tab"
                                aria-controls="contact" aria-selected="false">Unit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary font-weight-bold" id="contact-tab" data-toggle="tab" href="#component" role="tab"
                                aria-controls="contact" aria-selected="false">Component</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary font-weight-bold" id="part-tab" data-toggle="tab" href="#part" role="tab"
                                aria-controls="part" aria-selected="false">Part</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="group" role="tabpanel" aria-labelledby="profile-tab"><br>
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Specification</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Specification</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    ${data_group}
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="subgroup" role="tabpanel" aria-labelledby="profile-tab"><br>
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Specification</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Specification</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    ${data_sub_group}
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="unit" role="tabpanel" aria-labelledby="contact-tab">
                            <br>
                            <table class="table table-striped" id="table-3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Maker</th>
                                        <th>Part Number</th>
                                        <th>Serial Number</th>
                                        <th>Specification</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Maker</th>
                                        <th>Part Number</th>
                                        <th>Serial Number</th>
                                        <th>Specification</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    ${data_unit}
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="component" role="tabpanel" aria-labelledby="contact-tab"><br>
                            <table class="table table-striped" id="table-4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Maker</th>
                                        <th>Part Number</th>
                                        <th>Serial Number</th>
                                        <th>Specification</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Maker</th>
                                        <th>Part Number</th>
                                        <th>Serial Number</th>
                                        <th>Specification</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    ${data_component}
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="part" role="tabpanel" aria-labelledby="contact-tab"><br>
                            <table class="table table-striped" id="table-5">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Maker</th>
                                        <th>Part Number</th>
                                        <th>Serial Number</th>
                                        <th>Specification</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Maker</th>
                                        <th>Part Number</th>
                                        <th>Serial Number</th>
                                        <th>Specification</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    ${data_part}
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;

                    $('.data-main-group').html(html);
                    $('#table').DataTable();
                    $('#table-1').DataTable();
                    $('#table-2').DataTable();
                    $('#table-3').DataTable();
                    $('#table-4').DataTable();
                    $('#table-5').DataTable();

                    $('#spek').summernote({
                        tabsize: 2,
                        height: 200
                    });
                    // $('#inspection').summernote({
                    //     tabsize: 2,
                    //     height: 100
                    // });
            })




        });
        //Modal Create
        $('#chooseCreate').on('change', function(){
            var kode = $('#chooseCreate').val();
            // console.log(kode);

            if (kode == 'main_group') {
                $('.createGroup, .createSubGroup, .specification, .createUnit, .createComponent, .createPart, .chooseMainGroup, .chooseGroup, .chooseSubGroup, .chooseUnit, .chooseComponent, .maker, .serial_number, .part_number, .files').hide();
                $('.createMainGroup').show();
                $('.multiGroup, .multiSpekGroup, .multiSubGroup, .multiSpekSubGroup').each(function(){
                    $(this).remove()
                });
                $('.multiUnit, .multiMakerUnit, .multiSerialNumberUnit, .multiPartNumberUnit, .multiSpekUnit, .multiImagesUnit').each(function(){
                    $(this).remove()
                });
                $('.multiComponent, .multiMakerComponent, .multiSerialNumberComponent, .multiPartNumberComponent, .multiSpekComponent, .multiImagesComponent').each(function(){
                    $(this).remove()
                });
                $('.multiPart, .multiMakerPart, .multiSerialNumberPart, .multiPartNumberPart, .multiSpekPart, .multiImagesPart').each(function(){
                    $(this).remove()
                });

                $("[name='main_group[]']").attr('required', true);
                $("[name='group[]'],[name='sub_group[]'],[name='unit[]'],[name='component[]'],[name='part[]'],[name='maker[]'],[name='serial-number[]'],[name='part-number[]'],[name='images[]']").attr('required', false);

                $('#addMainGroup').on('click', function(){
                    var addMultiMainGroup =
                    '<div class="col-12 multiMainGroup">'+
                        '<hr><input type="text" class="form-control mt-2" placeholder="Input Main Group Name" name="main_group[]">'+
                    '</div>'
                    $('.append').append(addMultiMainGroup);

                    $("[name='main_group[]']").each(function(){
                        $(this).attr('required', true)
                    });
                })

                $('#removeMainGroup').on('click', function(){
                    $('.multiMainGroup').remove()
                })

            }

            else if (kode == 'group') {
                $('.createMainGroup, .createSubGroup, .createUnit, .createComponent, .createPart, .chooseGroup, .chooseSubGroup, .chooseUnit, .chooseComponent, .maker, .serial_number, .part_number, .files').hide();
                $('.createGroup, .specification, .chooseMainGroup').show();
                $('#specification').summernote();

                $('.multiMainGroup, .multiSubGroup, .multiSpekSubGroup').each(function(){
                    $(this).remove()
                });

                $('.multiUnit, .multiMakerUnit, .multiSerialNumberUnit, .multiPartNumberUnit, .multiSpekUnit, .multiImagesUnit').each(function(){
                    $(this).remove()
                });

                $('.multiComponent, .multiMakerComponent, .multiSerialNumberComponent, .multiPartNumberComponent, .multiSpekComponent, .multiImagesComponent').each(function(){
                    $(this).remove()
                });

                $('.multiPart, .multiMakerPart, .multiSerialNumberPart, .multiPartNumberPart, .multiSpekPart, .multiImagesPart').each(function(){
                    $(this).remove()
                });

                $("[name='group[]']").attr('required', true);
                $("[name='main_group[]'],[name='sub_group[]'],[name='unit[]'],[name='component[]'],[name='part[]'],[name='maker[]'],[name='serial-number[]'],[name='part-number[]'],[name='images[]']").attr('required', false);

                $("[name='kodeMainGroup']").attr('required', true);
                $("[name='kodeGroup'],[name='kodeSubGroup'],[name='kodeUnit'],[name='kodeComponent']").attr('required', false);


                var addMultiGroup =
                '<div class="col-12 multiGroup">'+
                    '<hr><label class="font-weight-bold">Group</label>'+
                    '<input type="text" class="form-control mt-2" placeholder="Input Group Name" name="group[]">'+
                '</div>'+
                '<div class="col-12 multiSpekGroup">'+
                    '<label class="font-weight-bold mt-3">Specification</label>'+
                    '<textarea type="text" class="form-control spek" id="specification" name="spek[]"></textarea>'+
                '</div>'

                $('#addGroup').on('click', function(){
                    $('.append').append(addMultiGroup);
                    $('.spek').each(function(){
                        $(this).summernote()
                    });

                    $("[name='group[]']").each(function(){
                        $(this).attr('required', true)
                    });
                })

                $('#removeGroup').on('click', function(){
                    $('.multiGroup, .multiSpekGroup').remove()
                })


            }

            else if (kode == 'sub_group') {
                $('.createMainGroup, .createGroup, .createUnit, .createComponent, .createPart, .chooseSubGroup, .chooseUnit, .chooseComponent, .maker, .serial_number, .part_number, .files').hide();
                $('.createSubGroup, .specification, .chooseMainGroup, .chooseGroup').show();
                $('#specification').summernote();
                $('#create_group_list').prop('disabled', true);
                $('.multiMainGroup, .multiGroup, .multiSpekGroup').each(function(){
                    $(this).remove()
                });
                $('.multiUnit, .multiMakerUnit, .multiSerialNumberUnit, .multiPartNumberUnit, .multiSpekUnit, .multiImagesUnit').each(function(){
                    $(this).remove()
                });
                $('.multiComponent, .multiMakerComponent, .multiSerialNumberComponent, .multiPartNumberComponent, .multiSpekComponent, .multiImagesComponent').each(function(){
                    $(this).remove()
                });
                $('.multiPart, .multiMakerPart, .multiSerialNumberPart, .multiPartNumberPart, .multiSpekPart, .multiImagesPart').each(function(){
                    $(this).remove()
                });

                $("[name='sub_group[]']").attr('required', true);
                $("[name='main_group[]'],[name='group[]'],[name='unit[]'],[name='component[]'],[name='part[]'],[name='maker[]'],[name='serial-number[]'],[name='part-number[]'],[name='images[]']").attr('required', false);

                $("[name='kodeMainGroup'],[name='kodeGroup']").attr('required', true);
                $("[name='kodeSubGroup'],[name='kodeUnit'],[name='kodeComponent']").attr('required', false);

                $('#create_main_group_list').on('change click', function(e) {
                    var data = $('#create_main_group_list').select2("val");
                    console.log(data);
                    Livewire.emit('selectMainGroup', data)
                });

                $(document).on('groupData', event => {
                    var data = event.detail.group;
                    // console.log(data);
                    $('#create_group_list').html('')
                    $('#create_group_list').append('<option value=""> --- Choose Group --- </option>')

                    if (data == '') {
                        $('#create_group_list').prop('disabled', true);
                    } else {
                        $('#create_group_list').prop('disabled', false);
                    }
                    $.each(data, function() {
                        console.log(this);
                        $('#create_group_list').append(
                            // '<option value=""> --- Choose Group --- </option>')
                            `<option value="${this.id}">${this.code}-${this.name}</option>`)
                    })
                })

                var addMultiSubGroup =
                    '<div class="col-12 multiSubGroup">'+
                        '<hr><label class="font-weight-bold">Sub Group</label>'+
                        '<input type="text" class="form-control mt-2" placeholder="Input Sub Group Name" name="sub_group[]">'+
                    '</div>'+
                    '<div class="col-12 multiSpekSubGroup">'+
                        '<label class="font-weight-bold mt-3">Specification</label>'+
                        '<textarea type="text" class="form-control spek" id="specification" name="spek[]"></textarea>'+
                    '</div>'

                    $('#addSubGroup').on('click', function(){
                        $('.append').append(addMultiSubGroup);
                        $('.spek').each(function(){
                            $(this).summernote()
                        });

                        $("[name='sub_group[]']").each(function(){
                        $(this).attr('required', true)
                    });
                    })

                    $('#removeSubGroup').on('click', function(){
                        $('.multiSubGroup, .multiSpekSubGroup').remove()
                    })
            }
            else if (kode == 'unit') {
                $('.createMainGroup, .createGroup, .createSubGroup, .createComponent, .createPart, .chooseUnit, .chooseComponent').hide();
                $('.createUnit, .specification, .chooseMainGroup, .chooseGroup, .chooseSubGroup, .maker, .serial_number, .part_number, .files').show();
                $('#specification').summernote();
                $('.multiMainGroup, .multiGroup, .multiSpekGroup, .multiSubGroup, .multiSpekSubGroup').each(function(){
                    $(this).remove()
                });
                $('.multiComponent, .multiMakerComponent, .multiSerialNumberComponent, .multiPartNumberComponent, .multiSpekComponent, .multiImagesComponent').each(function(){
                    $(this).remove()
                });
                $('.multiPart, .multiMakerPart, .multiSerialNumberPart, .multiPartNumberPart, .multiSpekPart, .multiImagesPart').each(function(){
                    $(this).remove()
                });

                $("[name='unit[]'],[name='maker[]'],[name='serial-number[]'],[name='part-number[]'],[name='images[]']").attr('required', true);
                $("[name='main_group[]'],[name='group[]'],[name='sub_group[]'],[name='component[]'],[name='part[]']").attr('required', false);

                $("[name='kodeMainGroup'],[name='kodeGroup'],[name='kodeSubGroup']").attr('required', true);
                $("[name='kodeUnit'],[name='kodeComponent']").attr('required', false);

                $('#create_group_list, #create_sub_group_list').prop('disabled', true);

                $('#create_main_group_list').on('change click', function(e) {
                    var data = $('#create_main_group_list').select2("val");
                    console.log(data);
                    Livewire.emit('selectMainGroup', data)
                });
                $(document).on('groupData', event => {
                    var data = event.detail.group;
                    // console.log(data);
                    $('#create_group_list').html('')
                    $('#create_group_list').append('<option value=""> --- Choose Group --- </option>')

                    if (data == '') {
                        $('#create_group_list').prop('disabled', true);
                        $('#create_group_list').html('')
                        $('#create_group_list').append('<option value=""> No Group </option>')
                    } else {
                        $('#create_group_list').prop('disabled', false);
                    }
                    $.each(data, function() {
                        console.log(this);
                        $('#create_group_list').append(
                            `<option value="${this.id}">${this.code}-${this.name}</option>`)
                    })
                })

                $('#create_group_list').on('change click', function(e) {
                    var data = $('#create_group_list').select2("val");
                    Livewire.emit('selectGroup', data)

                    $(document).on('subgroupData', event => {
                    var data = event.detail.subgroup;
                    $('#create_sub_group_list').html('')
                    $('#create_sub_group_list').append('<option value=""> --- Choose Sub Group --- </option>')
                    if (data == '') {
                        $('#create_sub_group_list').prop('disabled', true);
                        $('#create_sub_group_list').html('')
                        $('#create_sub_group_list').append('<option value=""> No Sub Group </option>')
                    } else {
                        $('#create_sub_group_list').prop('disabled', false);
                    }
                    $.each(data, function() {
                        $('#create_sub_group_list').append(
                            `<option value="${this.id}">${this.code}-${this.name}</option>`)
                    })
                })
                });



                var addMultiUnit = `
                <div class="col-12 mt-2 multiUnit">
                    <hr><label class="font-weight-bold">Unit</label>
                    <input type="text" class="form-control mt-2" placeholder="Input Unit Name" name="unit[]">
                </div>
                <div class="col-12 multiMakerUnit">
                    <label class="font-weight-bold mt-3">Maker</label>
                    <input type="text" class="form-control mt-2" placeholder="Input Maker" name="maker[]">
                </div>
                <div class="col-6 multiSerialNumberUnit">
                    <label class="font-weight-bold mt-3">Serial Number</label>
                    <input type="text" class="form-control mt-2" placeholder="Input Serial Number" name="serial-number[]">
                </div>
                <div class="col-6 multiPartNumberUnit">
                    <label class="font-weight-bold mt-3">Part Number</label>
                    <input type="text" class="form-control mt-2" placeholder="Input Part Number" name="part-number[]">
                </div>
                <div class="col-12 multiSpekUnit" >
                    <label class="font-weight-bold mt-3">Specification</label>
                    <textarea type="text" class="form-control spek" id="specification" name="spek[]"></textarea>
                </div>
                <div class="col-12 form-group multiImagesUnit">
                    <label class="font-weight-bold mt-3">Upload Image</label>
                    <input type="file" class="form-control-file" id="images" name="images[]">
                </div> `;

                // var i = 0;
                $('#addUnit').on('click', function(){
                    $('.append').append(addMultiUnit);
                    // i = i+1;
                    // console.log(i);
                    // $('.multiImagesUnit').append('<label class="font-weight-bold mt-3">Upload Image</label>'+
                    //                             '<input type="file" class="form-control-file" id="images" name="images['+i+']">');
                    // $('.multiImagesUnit').append(
                    //     $('<input/>').attr('type', 'file').attr('name', 'images'+i).attr('class','form-control-file').attr('id','images')
                    // );
                    $('.spek').each(function(){
                        $(this).summernote()
                    });

                    $("[name='unit[]'],[name='maker[]'],[name='serial-number[]'],[name='part-number[]'],[name='images[]']").each(function(){
                        $(this).attr('required', true)
                    });
                })

                $('#removeUnit').on('click', function(){
                    // i = 0;
                    $('.multiUnit, .multiMakerUnit, .multiSerialNumberUnit, .multiPartNumberUnit, .multiSpekUnit, .multiImagesUnit').remove()
                })


            }
            else if (kode == 'component') {
                $('.createMainGroup, .createGroup, .createSubGroup, .createUnit, .createPart, .chooseComponent').hide();
                $('.createComponent, .specification, .chooseMainGroup, .chooseGroup, .chooseSubGroup, .chooseUnit, .maker, .serial_number, .part_number, .files').show();
                $('#specification').summernote();
                $('.multiMainGroup, .multiGroup, .multiSpekGroup, .multiSubGroup, .multiSpekSubGroup').each(function(){
                    $(this).remove()
                });
                $('.multiUnit, .multiMakerUnit, .multiSerialNumberUnit, .multiPartNumberUnit, .multiSpekUnit, .multiImagesUnit').each(function(){
                    $(this).remove()
                });
                $('.multiPart, .multiMakerPart, .multiSerialNumberPart, .multiPartNumberPart, .multiSpekPart, .multiImagesPart').each(function(){
                    $(this).remove()
                });

                $("[name='component[]'],[name='maker[]'],[name='serial-number[]'],[name='part-number[]'],[name='images[]']").attr('required', true);
                $("[name='main_group[]'],[name='group[]'],[name='sub_group[]'],[name='unit[]'],[name='part[]']").attr('required', false);

                $("[name='kodeMainGroup'],[name='kodeGroup'],[name='kodeSubGroup'],[name='kodeUnit']").attr('required', true);
                $("[name='kodeComponent']").attr('required', false);

                $('#create_group_list, #create_sub_group_list, #create_unit_list').prop('disabled', true);

                $('#create_main_group_list').on('change click', function(e) {
                    var data = $('#create_main_group_list').select2("val");
                    console.log(data);
                    Livewire.emit('selectMainGroup', data)
                });
                $(document).on('groupData', event => {
                    var data = event.detail.group;
                    // console.log(data);
                    $('#create_group_list').html('')
                    $('#create_group_list').append('<option value=""> --- Choose Group --- </option>')

                    if (data == '') {
                        $('#create_group_list').prop('disabled', true);
                    } else {
                        $('#create_group_list').prop('disabled', false);
                    }
                    $.each(data, function() {
                        console.log(this);
                        $('#create_group_list').append(
                            // '<option value=""> --- Choose Group --- </option>')
                            `<option value="${this.id}">${this.code}-${this.name}</option>`)
                    })
                })

                $('#create_group_list').on('change click', function(e) {
                    var data = $('#create_group_list').select2("val");
                    Livewire.emit('selectGroup', data)

                    $(document).on('subgroupData', event => {
                        var data = event.detail.subgroup;
                        $('#create_sub_group_list').html('')
                        $('#create_sub_group_list').append('<option value=""> --- Choose Sub Group --- </option>')
                        if (data == '') {
                            $('#create_sub_group_list').prop('disabled', true);
                        } else {
                            $('#create_sub_group_list').prop('disabled', false);
                        }
                        $.each(data, function() {
                            $('#create_sub_group_list').append(
                                `<option value="${this.id}">${this.code}-${this.name}</option>`)
                        })
                    })
                });

                $('#create_sub_group_list').on('change click', function(e) {
                    var data = $('#create_sub_group_list').select2("val");
                    Livewire.emit('selectSubGroup', data)
                    $(document).on('unitData', event => {
                        var data = event.detail.unit;
                        $('#create_unit_list').html('')
                        $('#create_unit_list').append('<option value=""> --- Choose Unit --- </option>')
                        if (data == '') {
                            $('#create_unit_list').prop('disabled', true);
                            $('#create_unit_list').html('')
                            $('#create_unit_list').append('<option value=""> No Unit </option>')
                        } else {
                            $('#create_unit_list').prop('disabled', false);
                        }
                        $.each(data, function() {
                            $('#create_unit_list').append(
                                `<option value="${this.id}">${this.code}-${this.name}</option>`)
                        })
                    })
                });

                var addMultiComponent =
                '<div class="col-12 mt-2 multiComponent" >'+
                    '<hr><label class="font-weight-bold">Component</label>'+
                    '<input type="text" class="form-control mt-2" placeholder="Input Component Name" name="component[]">'+
                '</div>'+
                '<div class="col-12 multiMakerComponent">'+
                    '<label class="font-weight-bold mt-3">Maker</label>'+
                    '<input type="text" class="form-control mt-2" placeholder="Input Maker" name="maker[]">'+
                '</div>'+
                '<div class="col-6 multiSerialNumberComponent">'+
                    '<label class="font-weight-bold mt-3">Serial Number</label>'+
                    '<input type="text" class="form-control mt-2" placeholder="Input Serial Number" name="serial-number[]">'+
                '</div>'+
                '<div class="col-6 multiPartNumberComponent">'+
                    '<label class="font-weight-bold mt-3">Part Number</label>'+
                    '<input type="text" class="form-control mt-2" placeholder="Input Part Number" name="part-number[]">'+
                '</div>'+
                '<div class="col-12 multiSpekComponent">'+
                    '<label class="font-weight-bold mt-3">Specification</label>'+
                    '<textarea type="text" class="form-control spek" id="specification" name="spek[]"></textarea>'+
                '</div>'+
                '<div class="col-12 form-group multiImagesComponent">'+
                    '<label class="font-weight-bold mt-3">Upload Image</label>'+
                    '<input type="file" class="form-control-file" id="images" name="images[]">'+
                '</div>'

                $('#addComponent').on('click', function(){
                    $('.append').append(addMultiComponent);
                    $('.spek').each(function(){
                        $(this).summernote()
                    });

                    $("[name='component[]'],[name='maker[]'],[name='serial-number[]'],[name='part-number[]'],[name='images[]']").each(function(){
                        $(this).attr('required', true)
                    });
                })

                $('#removeComponent').on('click', function(){
                    $('.multiComponent, .multiMakerComponent, .multiSerialNumberComponent, .multiPartNumberComponent, .multiSpekComponent, .multiImagesComponent').remove()
                })
            }
            else {
                $('.createMainGroup, .createGroup, .createSubGroup, .createUnit, .createComponent').hide();
                $('.createPart, .specification, .chooseMainGroup, .chooseGroup, .chooseSubGroup, .chooseUnit, .chooseComponent, .maker, .serial_number, .part_number, .files').show();
                $('#specification').summernote();
                $('.multiMainGroup, .multiGroup, .multiSpekGroup, .multiSubGroup, .multiSpekSubGroup').each(function(){
                    $(this).remove()
                });
                $('.multiUnit, .multiMakerUnit, .multiSerialNumberUnit, .multiPartNumberUnit, .multiSpekUnit, .multiImagesUnit').each(function(){
                    $(this).remove()
                });
                $('.multiComponent, .multiMakerComponent, .multiSerialNumberComponent, .multiPartNumberComponent, .multiSpekComponent, .multiImagesComponent').each(function(){
                    $(this).remove()
                });

                $("[name='part[]'],[name='maker[]'],[name='serial-number[]'],[name='part-number[]'],[name='images[]']").attr('required', true);
                $("[name='main_group[]'],[name='group[]'],[name='sub_group[]'],[name='unit[]'],[name='component[]']").attr('required', false);

                $("[name='kodeMainGroup'],[name='kodeGroup'],[name='kodeSubGroup'],[name='kodeUnit'],[name='kodeComponent']").attr('required', true);

                $('#create_group_list, #create_sub_group_list, #create_unit_list, #create_component_list').prop('disabled', true);

                $('#create_main_group_list').on('change click', function(e) {
                    var data = $('#create_main_group_list').select2("val");
                    console.log(data);
                    Livewire.emit('selectMainGroup', data)
                });
                $(document).on('groupData', event => {
                    var data = event.detail.group;
                    // console.log(data);
                    $('#create_group_list').html('')
                    $('#create_group_list').append('<option value=""> --- Choose Group --- </option>')

                    if (data == '') {
                        $('#create_group_list').prop('disabled', true);
                    } else {
                        $('#create_group_list').prop('disabled', false);
                    }
                    $.each(data, function() {
                        console.log(this);
                        $('#create_group_list').append(
                            `<option value="${this.id}">${this.code}-${this.name}</option>`)
                    })
                })

                $('#create_group_list').on('change click', function(e) {
                    var data = $('#create_group_list').select2("val");
                    Livewire.emit('selectGroup', data)

                    $(document).on('subgroupData', event => {
                        var data = event.detail.subgroup;
                        $('#create_sub_group_list').html('')
                        $('#create_sub_group_list').append('<option value=""> --- Choose Sub Group --- </option>')
                        if (data == '') {
                            $('#create_sub_group_list').prop('disabled', true);
                        } else {
                            $('#create_sub_group_list').prop('disabled', false);
                        }
                        $.each(data, function() {
                            $('#create_sub_group_list').append(
                                `<option value="${this.id}">${this.code}-${this.name}</option>`)
                        })
                    })
                });

                $('#create_sub_group_list').on('change click', function(e) {
                    var data = $('#create_sub_group_list').select2("val");
                    Livewire.emit('selectSubGroup', data)
                    $(document).on('unitData', event => {
                        var data = event.detail.unit;
                        $('#create_unit_list').html('')
                        $('#create_unit_list').append('<option value=""> --- Choose Unit --- </option>')
                        if (data == '') {
                            $('#create_unit_list').prop('disabled', true);
                            $('#create_unit_list').html('')
                            $('#create_unit_list').append('<option value=""> No Unit </option>')
                        } else {
                            $('#create_unit_list').prop('disabled', false);
                        }
                        $.each(data, function() {
                            $('#create_unit_list').append(
                                `<option value="${this.id}">${this.code}-${this.name}</option>`)
                        })
                    })
                });

                $('#create_unit_list').on('change click', function(e) {
                    var data = $('#create_unit_list').select2("val");
                    Livewire.emit('selectUnit', data)
                    $(document).on('componentData', event => {
                        var data = event.detail.component;
                        $('#create_component_list').html('')
                        $('#create_component_list').append('<option value=""> --- Choose Component --- </option>')
                        if (data == '') {
                            $('#create_component_list').prop('disabled', true);
                            $('#create_component_list').html('')
                            $('#create_component_list').append('<option value=""> No Component </option>')
                        } else {
                            $('#create_component_list').prop('disabled', false);
                        }
                        $.each(data, function() {
                            $('#create_component_list').append(
                                `<option value="${this.id}">${this.code}-${this.name}</option>`)
                        })
                    })
                });

                var addMultiPart =
                '<div class="col-12 mt-2 multiPart">'+
                    '<hr><label class="font-weight-bold">Part</label>'+
                    '<input type="text" class="form-control mt-2" placeholder="Input Part Name" name="part[]">'+
                '</div>'+
                '<div class="col-12 multiMakerPart">'+
                    '<label class="font-weight-bold mt-3">Maker</label>'+
                    '<input type="text" class="form-control mt-2" placeholder="Input Maker" name="maker[]">'+
                '</div>'+
                '<div class="col-6 multiSerialNumberPart">'+
                    '<label class="font-weight-bold mt-3">Serial Number</label>'+
                    '<input type="text" class="form-control mt-2" placeholder="Input Serial Number" name="serial-number[]">'+
                '</div>'+
                '<div class="col-6 multiPartNumberPart">'+
                    '<label class="font-weight-bold mt-3">Part Number</label>'+
                    '<input type="text" class="form-control mt-2" placeholder="Input Part Number" name="part-number[]">'+
                '</div>'+
                '<div class="col-12 multiSpekPart">'+
                    '<label class="font-weight-bold mt-3">Specification</label>'+
                    '<textarea type="text" class="form-control spek" id="specification" name="spek[]"></textarea>'+
                '</div>'+
                '<div class="col-12 form-group multiImagesPart">'+
                    '<label class="font-weight-bold mt-3">Upload Image</label>'+
                    '<input type="file" class="form-control-file" id="images" name="images[]">'+
                '</div>'

                $('#addPart').on('click', function(){
                    $('.append').append(addMultiPart);
                    $('.spek').each(function(){
                        $(this).summernote()
                    });

                    $("[name='part[]'],[name='maker[]'],[name='serial-number[]'],[name='part-number[]'],[name='images[]']").each(function(){
                        $(this).attr('required', true)
                    });
                })

                $('#removePart').on('click', function(){
                    $('.multiPart, .multiSpekPart, .multiMakerPart, .multiSerialNumberPart, .multiPartNumberPart, multiImagesPart').remove()
                })
            }

            $('#create_main_group_list').select2({
                theme: 'bootstrap4',
                dropdownParent: $('.chooseMainGroup')
            });

            $('#create_group_list').select2({
                theme: 'bootstrap4',
                dropdownParent: $('.chooseGroup')
            });
            $('#create_sub_group_list').select2({
                theme: 'bootstrap4',
                dropdownParent: $('.chooseSubGroup')
            });
            $('#create_unit_list').select2({
                theme: 'bootstrap4',
                dropdownParent: $('.chooseUnit')
            });
            $('#create_component_list').select2({
                theme: 'bootstrap4',
                dropdownParent: $('.chooseComponent')
            });

        });

    </script>
@endpush
