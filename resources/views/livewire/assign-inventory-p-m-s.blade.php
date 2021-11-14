<div>
    <div wire:ignore class="modal fade" id="assignInventory" data-backdrop="static" data-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white bg-primary">
                    <h5 class="modal-title" id="staticBackdropLabel">Assign Inventory <span id="name-pms"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success alert-dismissible fade show" id="successAssign" role="alert">
                        <strong>Success!</strong> You has Assign Group Inventory to Taskjob.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade show" id="failedAssign" role="alert">
                        <strong>Failed!</strong> You not Choose Group Inventory.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="font-weight-bold">Select Group Inventory</label>
                                </div>
                                <div class="col-md-10">
                                    <select class="form-control" style="width: 100% !important"
                                        id="inventoryListGroup">
                                        @foreach ($group_inventory as $gi)
                                            <option value="{{ $gi->id }}">{{ $gi->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a class="btn btn-md btn-success" id="assignGroup"><i class="fa fa-sign-in-alt"></i>
                                        Assign Group</a>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <table class="mt-5 w-100" style="background: rgba(255, 255, 255, 0)"
                                        id="tableAssignInventory">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Qty</th>
                                                <th>Required</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listItemInventoryAssign">

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Qty</th>
                                                <th>Required</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-primary">
                    <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i>
                        Send</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('assign-inventory')
    <script>
        $(document).on('listInventory', event => {
            // console.log(event.detail);
            $('#listItemInventoryAssign').html("")
            var data = event.detail.listItem;
            for (let index = 0; index < event.detail.listItem.length; index++) {
                $('#listItemInventoryAssign').append(`
                    <tr>
                        <td>${data[index].group.name}</td>
                        <td>${data[index].ready == null ? 0 : data[index].ready}</td>
                        <td><input type="number" class="form-control" placeholder="Input Reqruiment Qty"></td>
                        <td><a href="#" class="btn btn-sm btn-warning text-white"><i class="fa fa-address-book"></i>&nbsp; Reserve Item</a></td>
                    </tr>
                `)

            }

        })

        $('#successAssign').hide();
        $('#failedAssign').hide();
        $('#inventoryListGroup').select2({
            theme: 'bootstrap4',
        })

        $('#inventoryListGroup').change(function() {
            var data = $(this).select2("val");
            Livewire.emit('setInventoryGroup', data)
        });

        $('#assignGroup').click(function() {
            Livewire.emit('assignGroupInventory');
        })

        function setGroupCode(id, assign_inventory) {
            console.log(id, assign_inventory);
            $('#inventoryListGroup').val(assign_inventory)
            $('#inventoryListGroup').select2({
                theme: 'bootstrap4',
            }).trigger('change')

            Livewire.emit('setGroupCode', id);
            Livewire.emit('getListInventory', assign_inventory)
        }


        $(document).on('assignInventory',
            event => {
                console.log(event.detail)
                if (event.detail.idGroupInventory == null) {
                    $('#failedAssign').show();
                    setTimeout(() => {
                        $('#failedAssign').hide();
                    }, 3000);
                } else {
                    $('#successAssign').show();
                    setTimeout(() => {
                        $('#successAssign').hide();
                    }, 3000);
                }
            })
    </script>
@endpush
