 @extends('layouts.layout')
 @section('content')
     <?php
     $no = 1;
     ?>
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
                                 <div class="col-12 mb-3">
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
                                 <div class="col-3">
                                     <label class="font-weight-bold">Group</label>
                                     <select class="form-control" id="group_list">
                                         @foreach ($group as $g)
                                             <option value="{{ $g->kode }}" class="{{ $g->kode1 }}">
                                                 {{ $g->kode }}-{{ $g->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                                 <div class="col-3">
                                     <label class="font-weight-bold">Sub Group</label>
                                     <select class="form-control" id="sub_group_list">
                                         @foreach ($sub_group as $sg)
                                             <option value="{{ $sg->kode }}" class="{{ $sg->kode2 }}">
                                                 {{ $sg->kode }}-{{ $sg->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                                 <div class="col-3">
                                     <label class="font-weight-bold">Unit</label>
                                     <select class="form-control" id="unit_list">
                                         @foreach ($unit as $u)
                                             <option value="{{ $u->kode }}" class="{{ $u->kode3 }}">
                                                 {{ $u->kode }}-{{ $u->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                                 <div class="col-3">
                                     <label class="font-weight-bold">Component</label>
                                     <select class="form-control" id="component_list">
                                         @foreach ($component as $c)
                                             <option value="{{ $c->kode }}" class="{{ $c->kode4 }}">
                                                 {{ $c->kode }}-{{ $c->name }}</option>
                                         @endforeach
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
     @endsection
