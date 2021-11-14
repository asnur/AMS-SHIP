<?php
$no = 1;
?>
<div>

    <div>
        <div class="container-fluid">

         <!-- Page Heading -->
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
             <h1 class="h3 mb-0 text-gray-800">Main Group</h1>
             {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
         </div>

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
                                         <option value="{{ $mg->kode }}">{{ $mg->kode }}-{{ $mg->name }}
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
     </div>
</div>

@push('group_inventory')
    <script>
        $('#main_group_list, #group_list, #sub_group_list, #unit_list, #component_list')
            .select2({
                theme: 'bootstrap4',
            });

        $('#group_list').prop('disabled', true);
        $('#sub_group_list').prop('disabled', true);
        $('#unit_list').prop('disabled', true);
        $('#component_list').prop('disabled', true);

        $('#main_group_list').change(function(e) {
            var data = $('#main_group_list').select2("val");
            Livewire.emit('selectMainGroup', data)
        });

        $(document).on('groupData', event => {
            var data = event.detail.group;
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
                $('unit_list').append('<option value=""> --- Choose Unit --- </option>')
                $('#component_list').prop('disabled', true);
                $('#component_list').html('')
                $('#component_list').append('<option value=""> --- Choose Component --- </option>')
            }
            $.each(data, function() {
                $('#group_list').append(
                    `<option value="${this.kode}">${this.kode}-${this.name}</option>`)
            })
        })

        $('#group_list').change(function(e) {
            var data = $('#group_list').select2("val");
            Livewire.emit('selectGroup', data)
        });

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
                    `<option value="${this.kode}">${this.kode}-${this.name}</option>`)
            })
        })

        $('#sub_group_list').change(function(e) {
            var data = $('#sub_group_list').select2("val");
            Livewire.emit('selectSubGroup', data)
        });


        $(document).on('unitData', event => {
            var data = event.detail.unit;
            $('#unit_list').html('')
            $('#unit_list').append('<option value=""> --- Choose Unit --- </option>')
            if (data == '') {
                $('#unit_list').prop('disabled', true);
                $('#component_list').prop('disabled', true);
                $('#unit_list').html('')
                $('#unit_list').append('<option value=""> No Unit </option>')
            } else {
                $('#unit_list').prop('disabled', false);
                $('#component_list').prop('disabled', true);
                $('#component_list').html('')
                $('#component_list').append('<option value=""> --- Choose Component --- </option>')
            }
            $.each(data, function() {
                $('#unit_list').append(
                    `<option value="${this.kode}">${this.kode}-${this.name}</option>`)
            })
        })

        $('#unit_list').change(function(e) {
            var data = $('#unit_list').select2("val");
            Livewire.emit('selectUnit', data)
        });


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
                    `<option value="${this.kode}">${this.kode}-${this.name}</option>`)
            })
        })

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
                                    <td>${obj.kode}</td>
                                    <td>${obj.name}</td>
                                    <td>${obj.spek}</td>
                                </tr>
                            `;
                    });

                    $.each(sub_group_data, function(i, obj) {
                        data_sub_group += `
                            <tr>
                                    <td>${i+1}</td>
                                    <td>${obj.kode}</td>
                                    <td>${obj.name}</td>
                                    <td>${obj.spek}</td>
                                </tr>
                            `;
                    });

                    $.each(unit_data, function(i, obj) {
                        data_unit += `
                            <tr>
                                    <td>${i+1}</td>
                                    <td>${obj.kode}</td>
                                    <td>${obj.name}</td>
                                    <td>${obj.spek}</td>
                                    <td>${obj.inspection}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" onclick="editUnit(${obj.kode})" data-toggle="modal" data-target="#editUnit"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            `;

                    });

                    $.each(component_data, function(i, obj) {
                        data_component += `
                            <tr>
                                    <td>${i+1}</td>
                                    <td>${obj.kode}</td>
                                    <td>${obj.name}</td>
                                    <td>${obj.spek}</td>
                                    <td>${obj.inspection}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" onclick="editComponent(${obj.kode})" data-toggle="modal" data-target="#editComponent"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            `;
                    });
                    $.each(part_data, function(i, obj) {
                        data_part += `
                            <tr>
                                    <td>${i+1}</td>
                                    <td>${obj.kode}</td>
                                    <td>${obj.name}</td>
                                    <td>${obj.spek}</td>
                                    <td>${obj.inspection}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" onclick="editPart(${obj.kode})" data-toggle="modal" data-target="#editPart"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-warning text-white" href="/admin/detail-sub-part/${obj.kode}"><i class="fa fa-eye"></i></a>
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
                                    <label class="font-weight-bold">Code</label>
                                    <input type="text" readonly class="form-control" name="kode" id="kode_unit">
                                    <label class="font-weight-bold mt-3">Name</label>
                                    <input type="text" readonly class="form-control" name="nama" id="nama_unit">
                                    <label class="font-weight-bold mt-3">Spesification</label>
                                    <textarea type="text" class="form-control" id="spek_unit" name="spek"></textarea>
                                    <label class="font-weight-bold mt-3">Inspection</label>
                                    <textarea type="text" class="form-control" name="inspection" id="inspection_unit"></textarea>
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
                                    <label class="font-weight-bold">Code</label>
                                    <input type="text" readonly class="form-control" name="kode" id="kode_component">
                                    <label class="font-weight-bold mt-3">Name</label>
                                    <input type="text" readonly class="form-control" name="nama" id="nama_component">
                                    <label class="font-weight-bold mt-3">Spesification</label>
                                    <textarea type="text" class="form-control" id="spek_component" name="spek"></textarea>
                                    <label class="font-weight-bold mt-3">Inspection</label>
                                    <textarea type="text" class="form-control" name="inspection" id="inspection_component"></textarea>
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
                                    <label class="font-weight-bold">Code</label>
                                    <input type="text" readonly class="form-control" name="kode" id="kode_part">
                                    <label class="font-weight-bold mt-3">Name</label>
                                    <input type="text" readonly class="form-control" name="nama" id="nama_part">
                                    <label class="font-weight-bold mt-3">Spesification</label>
                                    <textarea type="text" class="form-control" id="spek_part" name="spek"></textarea>
                                    <label class="font-weight-bold mt-3">Inspection</label>
                                    <textarea type="text" class="form-control" name="inspection" id="inspection_part"></textarea>
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
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Specification</th>
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
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Specification</th>
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
                                        <th>Specification</th>
                                        <th>Inspection</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Specification</th>
                                        <th>Inspection</th>
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
                                        <th>Specification</th>
                                        <th>Inspection</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Specification</th>
                                        <th>Inspection</th>
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
                                        <th>Specification</th>
                                        <th>Inspection</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Specification</th>
                                        <th>Inspection</th>
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
                        height: 100
                    });
                    $('#inspection').summernote({
                        tabsize: 2,
                        height: 100
                    });
            })




        });
    </script>
@endpush
