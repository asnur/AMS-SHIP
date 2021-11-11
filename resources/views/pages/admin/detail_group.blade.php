<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link text-danger font-weight-bold active" id="profile-tab" data-toggle="tab" href="#group"
            role="tab" aria-controls="profile" aria-selected="false">Group</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-danger font-weight-bold" id="profile-tab" data-toggle="tab" href="#subgroup" role="tab"
            aria-controls="profile" aria-selected="false">Sub Group</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-danger font-weight-bold" id="contact-tab" data-toggle="tab" href="#unit" role="tab"
            aria-controls="contact" aria-selected="false">Unit</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-danger font-weight-bold" id="contact-tab" data-toggle="tab" href="#component" role="tab"
            aria-controls="contact" aria-selected="false">Component</a>
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
                {{-- @if (!$group == '')
                        @foreach ($group as $g)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $g->kode }}</td>
                                <td>{{ $g->nama }}</td>
                                <td>{{ $g->spek }}</td>
                            </tr>
                        @endforeach
                    @endif --}}
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
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
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
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
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
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
