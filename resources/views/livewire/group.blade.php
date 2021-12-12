<?php
$no = 1;
?>

<div>
    <input type="text" id="selectedValueUnit" name="unit" class="d-none">
    <input type="text" id="selectedValueComponent" name="component" class="d-none">
    <input type="text" id="selectedValuePart" name="part" class="d-none">
    <div class="row">
        <div class="col-4" wire:ignore>
            <label class="font-weight-bold">Main Group</label>
            <select id="selectedMainGroup" class="form-control" style="width: 100% !important">
                <option value=""> --- Choose Main Group --- </option>
                @foreach ($main_group as $mg)
                    <option value="{{ $mg->id }}">{{ $mg->code }}-{{ $mg->name }}
                    </option>
                @endforeach
            </select><br>
        </div>

        <div class="col-4" wire:ignore>
            <label class="font-weight-bold">Group</label>
            <select id="selectedGroup" class="form-control" style="width: 100% !important">
                <option value=""> --- Choose Group --- </option>

            </select>
        </div>

        <div class="col-4" wire:ignore>
            <label class="font-weight-bold">Sub Group </label>
            <select id="selectedSubGroup" class="form-control" style="width: 100% !important">
                <option value=""> --- Choose Sub Group --- </option>
            </select>
        </div>

        <div class="col-4" wire:ignore>
            <label class="font-weight-bold">Unit <input type="checkbox" name="selected"
                    class="selected-inventory"></label>
            <select class="form-control" id="selectedUnit" style="width: 100% !important">
                <option value=""> --- Choose Unit --- </option>
            </select>
        </div>

        <div class="col-4" wire:ignore>
            <label class="font-weight-bold">Component <input type="checkbox" name="selected"
                    class="selected-inventory"></label>
            <select class="form-control" id="selectedComponent" style="width: 100% !important">
                <option value=""> --- Choose Component --- </option>
            </select>
        </div>

        <div class="col-4" wire:ignore>
            <label class="font-weight-bold">Part <input type="checkbox" name="selected"
                    class="selected-inventory"></label>
            <select class="form-control" id="selectedPart" style="width: 100% !important">
                <option value=""> --- Choose Unit --- </option>
            </select>
        </div>

        <div class="col-12 mt-3" wire:ignore>
            <label class="font-weight-bold">Group Inventory</label>
            {{-- {{ $selectedInventoryGroup }} --}}
            <select class="form-control" id="selectedInventoryGroup" style="width: 100% !important" name="id_group"
                required>
                <option value=""> --- Choose Group Inventory --- </option>
                @foreach ($inventory_group as $ig)
                    <option value="{{ $ig->id }}">{{ $ig->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-3 mt-3">
            <label class="font-weight-bold">Installed Qty</label>
            <input type="number" class="form-control" placeholder="Input Quantity Installed Item" name="installed">
        </div>
        <div class="col-3 mt-3">
            <label class="font-weight-bold">Used Qty</label>
            <input type="number" class="form-control" placeholder="Input Quantity Used Item" name="used">
        </div>
        <div class="col-3 mt-3">
            <label class="font-weight-bold">Reserved Qty</label>
            <input type="number" class="form-control" placeholder="Input Quantity Reserved Item" name="reserved">
        </div>
        <div class="col-3 mt-3">
            <label class="font-weight-bold">Ready Qty</label>
            <input type="number" class="form-control" placeholder="Input Quantity Ready Item" name="ready">
        </div>
        <div class="col-12 mt-3">
            <label class="font-weight-bold">Note</label>
            <textarea class="form-control" placeholder="Input Note for Item" name="note" rows="6"></textarea>
        </div>
    </div>
</div>

@push('group_inventory')
    <script>
        $('#selectedMainGroup, #selectedGroup, #selectedSubGroup, #selectedUnit, #selectedComponent, #selectedPart, #selectedInventoryGroup')
            .select2({
                theme: 'bootstrap4',
            });

        $('#selectedGroup').prop('disabled', true);
        $('#selectedSubGroup').prop('disabled', true);
        $('#selectedUnit').prop('disabled', true);
        $('#selectedComponent').prop('disabled', true);
        $('#selectedPart').prop('disabled', true);
        $('.selected-inventory').prop('disabled', true)

        $('#selectedMainGroup').change(function(e) {
            var data = $('#selectedMainGroup').select2("val");
            Livewire.emit('selectMainGroup', data)
        });


        $(document).on('groupData', event => {
            var data = event.detail.group;
            $('#selectedGroup').html('')
            $('#selectedGroup').append('<option value=""> --- Choose Group --- </option>')
            if (data == '') {
                $('#selectedGroup').prop('disabled', true);
                $('#selectedSubGroup').prop('disabled', true);
                $('#selectedUnit').prop('disabled', true);
                $('#selectedComponent').prop('disabled', true);
                $('#selectedPart').prop('disabled', true);
                $('.selected-inventory:eq(0)').prop('disabled', true)
                $('.selected-inventory:eq(1)').prop('disabled', true)
                $('.selected-inventory:eq(2)').prop('disabled', true)
            } else {
                $('#selectedGroup').prop('disabled', false);
                $('#selectedSubGroup').prop('disabled', true);
                $('#selectedUnit').prop('disabled', true);
                $('#selectedComponent').prop('disabled', true);
                $('#selectedPart').prop('disabled', true);
            }
            $.each(data, function() {
                $('#selectedGroup').append(
                    `<option value="${this.id}">${this.code}-${this.name}</option>`)
            })
        })

        $('#selectedGroup').change(function(e) {
            var data = $('#selectedGroup').select2("val");
            Livewire.emit('selectGroup', data)
        });

        $(document).on('subgroupData', event => {
            var data = event.detail.subgroup;
            $('#selectedSubGroup').html('')
            $('#selectedSubGroup').append('<option value=""> --- Choose Sub Group --- </option>')
            if (data == '') {
                $('#selectedSubGroup').prop('disabled', true);
                $('#selectedUnit').prop('disabled', true);
                $('#selectedComponent').prop('disabled', true);
                $('#selectedPart').prop('disabled', true);
                $('.selected-inventory:eq(0)').prop('disabled', true)
                $('.selected-inventory:eq(1)').prop('disabled', true)
                $('.selected-inventory:eq(2)').prop('disabled', true)
            } else {
                $('#selectedSubGroup').prop('disabled', false);
                $('#selectedUnit').prop('disabled', true);
                $('#selectedComponent').prop('disabled', true);
                $('#selectedPart').prop('disabled', true);
            }
            $.each(data, function() {
                $('#selectedSubGroup').append(
                    `<option value="${this.id}">${this.code}-${this.name}</option>`)
            })
        })

        $('#selectedSubGroup').change(function(e) {
            var data = $('#selectedSubGroup').select2("val");
            Livewire.emit('selectSubGroup', data)
        });


        $(document).on('unitData', event => {
            var data = event.detail.unit;
            $('#selectedUnit').html('')
            $('#selectedUnit').append('<option value=""> --- Choose Unit --- </option>')
            if (data == '') {
                $('#selectedUnit').prop('disabled', true);
                $('#selectedComponent').prop('disabled', true);
                $('#selectedPart').prop('disabled', true);
                $('.selected-inventory:eq(0)').prop('disabled', true)
            } else {
                $('#selectedUnit').prop('disabled', false);
                $('#selectedComponent').prop('disabled', true);
                $('.selected-inventory:eq(0)').prop('disabled', false)
            }
            $.each(data, function() {
                $('#selectedUnit').append(
                    `<option value="${this.id}">${this.code}-${this.name}</option>`)
            })
        })

        $('#selectedUnit').change(function(e) {
            var data = $('#selectedUnit').select2("val");
            Livewire.emit('selectUnit', data)
        });


        $(document).on('componentData', event => {
            var data = event.detail.component;
            $('#selectedComponent').html('')
            $('#selectedComponent').append('<option value=""> --- Choose Component --- </option>')
            if (data == '') {
                $('#selectedComponent').prop('disabled', true);
                $('#selectedPart').prop('disabled', true);
                $('.selected-inventory:eq(1)').prop('disabled', true)
                $('.selected-inventory:eq(2)').prop('disabled', true)
            } else {
                $('#selectedComponent').prop('disabled', false);
                $('.selected-inventory:eq(1)').prop('disabled', false)
            }
            $.each(data, function() {
                $('#selectedComponent').append(
                    `<option value="${this.id}">${this.code}-${this.name}</option>`)
            })
        })

        $('#selectedComponent').change(function(e) {
            var data = $('#selectedComponent').select2("val");
            Livewire.emit('selectComponent', data)
        });


        $(document).on('partData', event => {
            var data = event.detail.part;
            $('#selectedPart').html('')
            $('#selectedPart').append('<option value=""> --- Choose Part --- </option>')
            if (data == '') {
                $('#selectedPart').prop('disabled', true);
                $('.selected-inventory:eq(2)').prop('disabled', true)
            } else {
                $('#selectedPart').prop('disabled', false);
                $('.selected-inventory:eq(2)').prop('disabled', false)
            }
            $.each(data, function() {
                $('#selectedPart').append(
                    `<option value="${this.id}">${this.code}-${this.name}</option>`)
            })
        })

        $('#selectedInventoryGroup').change(function() {
            var data = $('#selectedInventoryGroup').select2("val");
            Livewire.emit('selectGroupInventory', data);
        })

        $(document).on('groupInventoryData', event => {
            var data = event.detail.groupInventory;
        })

        $('.selected-inventory:eq(0)').change(function() {
            if ($(this).prop('checked') == true) {
                $('#selectedValueUnit').val($('#selectedUnit').val())
                $('#selectedValueComponent').val("")
                $('#selectedValuePart').val("")
                console.log($('#selectedValueUnit').val())
            } else {
                console.log($('#selectedValueUnit').val())
            }
        })
        $('.selected-inventory:eq(1)').change(function() {
            if ($(this).prop('checked') == true) {
                $('#selectedValueUnit').val("")
                $('#selectedValueComponent').val($('#selectedComponent').val())
                $('#selectedValuePart').val("")
                console.log($('#selectedValueComponent').val())
            } else {
                console.log($('#selectedValueComponent').val())
            }
        })
        $('.selected-inventory:eq(2)').change(function() {
            if ($(this).prop('checked') == true) {
                $('#selectedValueUnit').val("")
                $('#selectedValueComponent').val("")
                $('#selectedValuePart').val($('#selectedPart').val())
                console.log($('#selectedValuePart').val())
            } else {
                console.log($('#selectedValuePart').val())
            }
        })
    </script>
@endpush
