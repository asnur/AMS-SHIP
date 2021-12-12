<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AMS - SHIP</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/asset-admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/asset-admin/img/favicon.ico" rel="icon">
    <link href="/asset-admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.0.5/css/scroller.dataTables.min.css"> --}}
    <style>
        #categoryFilter {
            display: inline;
            width: 200px;
            margin-left: 25px;
        }

        #categoryFilterUpcoming {
            display: inline;
            width: 200px;
            margin-left: 25px;
        }

        #categoryFilterOngoing {
            display: inline;
            width: 200px;
            margin-left: 25px;
        }

        #categoryFilterFinished {
            display: inline;
            width: 200px;
            margin-left: 25px;
        }

    </style>
    @livewireStyles
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="/asset-admin/img/bag-icon.png" style="width: 50px; height:50px;">
                </div>
                <div class="sidebar-brand-text mx-3">AMS-SHIP</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#syncronBtn"
                    aria-expanded="true" aria-controls="syncronBtn">
                    <i class="fas fa-fw fa-sync"></i>
                    <span>Syncronize</span></a>
                <div id="syncronBtn" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                        <a class="collapse-item" href="{{ route('pull-data') }}">Post Data</a>
                        <a class="collapse-item" href="{{ route('push-data') }}">Get Data</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Fitur
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo5"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-users"></i>
                    <span>User Management</span>
                </a>
                <div id="collapseTwo5" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                        <a class="collapse-item" href="{{ route('user-management') }}">User</a>
                        <a class="collapse-item" href="{{ route('role-management') }}">Role</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Management</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                        <a class="collapse-item" href="{{ route('group') }}">Main Group</a>
                        @if (auth()->user()->can('show taskjob'))
                            <a class="collapse-item" href="{{ route('taskjob') }}">Task Job</a>
                        @endif
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>PMS</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('PMS') }}">PMS</a>
                        <a class="collapse-item" href="#">Unscheduled</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('inventory') }}">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Inventory</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesReport"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Report</span>
                </a>
                <div id="collapsePagesReport" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">PMS</a>
                        <a class="collapse-item" href="#">Unscheduled</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="/asset-admin/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>




    <!-- Bootstrap core JavaScript-->
    <script src="/js/jquery.min.js"></script>
    <script src="/asset-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/asset-admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/asset-admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    {{-- <script src="/asset-admin/vendor/chart.js/Chart.min.js"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="/asset-admin/js/demo/chart-area-demo.js"></script>
    <script src="/asset-admin/js/demo/chart-pie-demo.js"></script> --}}
    <script src="/asset-admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/asset-admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/asset-admin/js/jquery-chained.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
    @include('sweetalert::alert')
    <script>
        $('#table-group').DataTable();

        $("#table-listtaskjob").dataTable({
            searching: true,
            responsive: true
        });
        @if (Request::segment(2) == 'taskjob')
            var list_taskjob = $('#table-listtaskjob').DataTable();
            $("#table-listtaskjob_filter.dataTables_filter").append($("#categoryFilter"));

            var categoryIndex = 0;
            $("#table-listtaskjob th").each(function(i) {
            if ($($(this)).html() == "Status") {
            categoryIndex = i;
            return false;
            }
            });

            $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
            var selectedItem = $('#categoryFilter').val()
            var category = data[categoryIndex];
            if (selectedItem === "" || category.includes(selectedItem)) {
            return true;
            }
            return false;
            }
            );

            $("#categoryFilter").val(Cookies.get('filter_status'))

            $("#categoryFilter").change(function(e) {
            list_taskjob.draw();
            Cookies.set('filter_status', $(this).val(), {
            expires: 1
            })

            });

            list_taskjob.draw();
        @endif

        @if (Request::segment(2) == 'PMS')
            var upcoming_taskjob = $('#table-listtaskjob-upcoming').DataTable();
            $("#table-listtaskjob-upcoming_filter.dataTables_filter").append($("#categoryFilterUpcoming"));

            var categoryIndexUpcoming = 0;
            $("#table-listtaskjob-upcoming th").each(function(i) {
            if ($($(this)).html() == "Status") {
            categoryIndexUpcoming = i;
            return false;
            }
            });

            $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
            var selectedItem = $('#categoryFilterUpcoming').val()
            var category = data[categoryIndexUpcoming];
            if (selectedItem === "" || category.includes(selectedItem)) {
            return true;
            }
            return false;
            }
            );

            $("#categoryFilterUpcoming").val(Cookies.get('filter_status_upcoming'))

            $("#categoryFilterUpcoming").change(function(e) {
            upcoming_taskjob.draw();
            Cookies.set('filter_status_upcoming', $(this).val(), {
            expires: 1
            })

            });

            upcoming_taskjob.draw();

            var ongoing_taskjob = $('#table-listtaskjob-ongoing').DataTable();
            $("#table-listtaskjob-ongoing_filter.dataTables_filter").append($("#categoryFilterOngoing"));

            var categoryIndexOngoing = 0;
            $("#table-listtaskjob-ongoing th").each(function(i) {
            if ($($(this)).html() == "Status") {
            categoryIndexOngoing = i;
            return false;
            }
            });

            $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
            var selectedItem = $('#categoryFilterOngoing').val()
            var category = data[categoryIndexOngoing];
            if (selectedItem === "" || category.includes(selectedItem)) {
            return true;
            }
            return false;
            }
            );

            $("#categoryFilterOngoing").val(Cookies.get('filter_status_ongoing'))

            $("#categoryFilterOngoing").change(function(e) {
            ongoing_taskjob.draw();
            Cookies.set('filter_status_ongoing', $(this).val(), {
            expires: 1
            })

            });

            ongoing_taskjob.draw();

            var finished_taskjob = $('#table-listtaskjob-finished').DataTable();
            $("#table-listtaskjob-finished_filter.dataTables_filter").append($("#categoryFilterFinished"));

            var categoryIndexFinished = 0;
            $("#table-listtaskjob-finished th").each(function(i) {
            if ($($(this)).html() == "Status") {
            categoryIndexFinished = i;
            return false;
            }
            });

            $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
            var selectedItem = $('#categoryFilterFinished').val()
            var category = data[categoryIndexFinished];
            if (selectedItem === "" || category.includes(selectedItem)) {
            return true;
            }
            return false;
            }
            );

            $("#categoryFilterFinished").val(Cookies.get('filter_status_finished'))

            $("#categoryFilterFinished").change(function(e) {
            finished_taskjob.draw();
            Cookies.set('filter_status_finished', $(this).val(), {
            expires: 1
            })

            });

            finished_taskjob.draw();
        @endif

        $('#group-data').DataTable();

        $('#jobdesk').summernote({
            tabsize: 2,
            height: 200
        });

        $('#action-pms').summernote({
            tabsize: 2,
            height: 200
        });

        $('#main_group_list').select2({
            theme: 'bootstrap4',
        });
        $('#group_list').select2({
            theme: 'bootstrap4',
        });
        $('#sub_group_list').select2({
            theme: 'bootstrap4',
        });
        $('#unit_list').select2({
            theme: 'bootstrap4',
        });
        $('#component_list').select2({
            theme: 'bootstrap4',
        });
        $('#part_list').select2({
            theme: 'bootstrap4',
        });
        $('#roles').select2({
            theme: 'bootstrap4',
        });
        $('#kode').select2({
            theme: 'bootstrap4',
        });
        $('#group_id').select2({
            theme: 'bootstrap4',
        });


        $("#group_list").chained("#main_group_list");
        $("#sub_group_list").chained("#group_list");
        $("#unit_list").chained("#sub_group_list");
        $("#component_list").chained("#unit_list");
        // $("#part_list").chained("#component_list");

        function editUnit(code) {
            $.ajax({
                type: 'get',
                url: "/admin/detail-unit",
                data: {
                    code: code
                },

                dataType: 'json',
                success: function(response) {
                    let result = response;
                    // console.log(result.code);
                    // console.log(result.images);
                    html = `<label class="font-weight-bold mt-3">Image</label>
                            <img src='{{asset('/img/${result.images}')}}' class="rounded mt-3 ml-3" height="250" alt="No Image" id="image_unit">`
                    $('#kode_unit').val();
                    $('#nama_unit').val();
                    $('#maker_unit').val();
                    $('#part_number_unit').val();
                    $('#serial_number_unit').val();
                    $('#spek_unit').val();

                    $('#kode_unit').val(result.code);
                    $('#nama_unit').val(result.name);
                    // $("#image_unit").attr({
                    //     'src' : "{{asset('/img/"+ result.images +"')}}"
                    // });
                    $('.image_unit').html(html);
                    $('#maker_unit').val(result.maker);
                    $('#part_number_unit').val(result.part_number);
                    $('#serial_number_unit').val(result.serial_number);
                    $('#spek_unit').summernote("code", result.specification);
                }
            });
        }

        function editComponent(code) {
            $.ajax({
                type: 'get',
                url: "/admin/detail-component",
                data: {
                    code: code
                },
                dataType: 'json',
                success: function(response) {
                    let result = response;
                    console.log(result.code);
                    html = `<label class="font-weight-bold mt-3">Image</label>
                            <img src='{{asset('/img/${result.images}')}}' class="rounded mt-3 ml-3" height="250" alt="No Image" id="image_component">`
                    $('#kode_component').val();
                    $('#nama_component').val();
                    $('#maker_component').val();
                    $('#part_number_component').val();
                    $('#serial_number_component').val();
                    $('#spek_component').val();

                    $('#kode_component').val(result.code);
                    $('#nama_component').val(result.name);
                    $('.image_component').html(html);
                    $('#maker_component').val(result.maker);
                    $('#part_number_component').val(result.part_number);
                    $('#serial_number_component').val(result.serial_number);
                    $('#spek_component').summernote("code", result.specification);
                }
            });
        }

        function editPart(code) {
            $.ajax({
                type: 'get',
                url: "/admin/detail-part",
                data: {
                    code: code
                },
                dataType: 'json',
                success: function(response) {
                    let result = response;
                    console.log(result.code);
                    $('#kode_part').val();
                    $('#nama_part').val();
                    $('#maker_component').val();
                    $('#part_number_component').val();
                    $('#serial_number_component').val();
                    $('#spek_part').val();

                    html = `<label class="font-weight-bold mt-3">Image</label>
                            <img src='{{asset('/img/${result.images}')}}' class="rounded mt-3 ml-3" height="250" alt="No Image" id="image_part">`

                    $('#kode_part').val(result.code);
                    $('#nama_part').val(result.name);
                    $('.image_part').html(html);
                    $('#maker_part').val(result.maker);
                    $('#part_number_part').val(result.part_number);
                    $('#serial_number_part').val(result.serial_number);
                    $('#spek_part').summernote("code", result.specification);
                }
            });
        }

        function editSubPart(kode) {
            $.ajax({
                type: 'get',
                url: "/admin/detail-subpart",
                data: {
                    kode: kode
                },
                dataType: 'json',
                success: function(response) {
                    let result = response;
                    console.log(result.kode);
                    $('#kode_sub_part').val();
                    $('#nama_sub_part').val();
                    $('#spek_sub_part').val();
                    $('#inspection_sub_part').val();

                    $('#kode_sub_part').val(result.kode);
                    $('#nama_sub_part').val(result.nama);
                    $('#spek_sub_part').summernote("code", result.spek);
                    $('#inspection_sub_part').summernote("code", result.inspection);
                }
            });
        }
    </script>
    @livewireScripts
    <script>
        var table = $('#table').DataTable({
            deferRender: true,
            responsive: true,
        });
        // $('#table-inventory').DataTable({
        //     deferRender: true,
        //     ajax: 'http://localhost:8000/admin/all-inventory',
        //     columns: [{
        //             data: 'item_code'
        //         },
        //         {
        //             data: 'installed' == null ? 'kode' : 'installed'
        //         },
        //         {
        //             data: 'used'
        //         },
        //         {
        //             data: 'reserved'
        //         },
        //         {
        //             data: 'ready'
        //         }
        //     ],
        //     responsive: true,
        // });

        var tmpData = [];

        var table_taskjob;
        table_taskjob = $('#table-taskjob').DataTable({
            responsive: true,
            // columnDefs: [{
            //     orderable: false,
            //     targets: 0,
            //     className: 'select-checkbox',
            // }],
            // select: {
            //     style: 'os',
            //     selector: 'td:first-child'
            // },
            // order: [
            //     [1, 'asc']
            // ]

            columnDefs: [{
                orderable: false,
                targets: 1,
                className: 'select-checkbox',
            }, {
                targets: 0,
                className: 'control'
            }],
            select: {
                style: 'os',
                selector: 'td:nth-child(2)'
            },
            order: [
                [2, 'asc']
            ]
        });


        $('#btnStartTaskJob').on('click', function() {
            var tblData = table_taskjob.rows('.selected').data();
            tmpData = [];
            $.each(tblData, function(i, val) {
                tmpData.push(tblData[i][2]);
            })

            // console.log(tmpData);

            $('#data-start').val();
            $('#data-start').val(tmpData);
        })

        $('#btnStopTaskJob').on('click', function() {
            var tblData = table_taskjob.rows('.selected').data();
            tmpData = [];
            $.each(tblData, function(i, val) {
                tmpData.push(tblData[i][2]);
            })

            // console.log(tmpData);

            $('#data-stop').val();
            $('#data-stop').val(tmpData);
        });

        function processRunningHour(id, name) {
            $('#idTaskJob').val();
            $('#name_group').val();

            $('#idTaskJob').val(id);
            $('#name_group').val(name);
        }

        function processRunningHourGroup(id, name) {
            $('#idTaskJobGroup').val();
            $('#name_group_grouping').val();

            $('#idTaskJobGroup').val(id);
            $('#name_group_grouping').val(name);
        }

        function historyTaskJob(item, name) {
            // console.log(item);
            var no = 1;
            $('#name_taskjob').text(name);
            var html = `
            <table class="table table-striped" id="table-history-taskjob">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Start Hour</th>
                                <th>End Hour</th>
                                <th>Total Hour</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Start Hour</th>
                                <th>End Hour</th>
                                <th>Total Hour</th>
                            </tr>
                        </tfoot>
                        <tbody>
            `;

            $.each(item, function(i, val) {
                html += `
                    <tr>
                        <td>${no++}</td>
                        <td>${val.start_hour}</td>
                        <td>${val.end_hour}</td>
                        <td>${val.total_hour}</td>
                    </tr>
                `;
            });

            html += `
                </tbody>
            </table>
            `;

            $('#log-running-hour').html(html);

            $('#table-history-taskjob').DataTable();
        }

        function name_taskjob(kode) {
            var name = '';
            $.ajax({
                type: 'GET',
                async: false,
                url: `/admin/group-name/${kode}`,
                success: function(response) {
                    name = response;
                }
            });

            return name;
        }

        // console.log(name_taskjob(1));

        function listTaskJob(item, name) {
            $('#title_group').text(name);
            // console.log(item);
            var no = 1;
            var html = `
            <table class="table table-striped" id="table-list-taskjob">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Job Desk</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Job Desk</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
            `;

            $.each(item, function(i, val) {
                html += `
                    <tr>
                        <td>${no++}</td>
                        <td>${name_taskjob(val.code)}</td>
                        <td>${val.jobdesk}</td>
                        <td>${(val.critical == 1) ? 'critical' : 'No Critical'}</td>
                    </tr>
                `;
            });

            html += `
                </tbody>
            </table>
            `;

            $('#listDetailTaskJob').html(html);

            $('#table-list-taskjob').DataTable();
        }

        function groupEdit(id, name) {
            $('#id_group_edit').val();
            $('#name_group_edit').val();

            $('#id_group_edit').val(id);
            $('#name_group_edit').val(name);
        }

        function giveRole(id, name, role) {
            $('#id-give-role').val();
            $('#name-taskjob-role').val();
            $('#role-taskjob').val();

            $('#id-give-role').val(id);
            $('#name-taskjob-role').val(name);
            $('#role-taskjob').val(role);
        }

        function giveRoleTaskJobGroup(id, name) {
            $('#id-give-role-group').val();

            $('#id-give-role-group').val(id);
            $('#name-group-give-role').text(name);
        }

        function prosesPMS(id, name) {
            $('#id-pms').val();
            $('#name-pms').val();

            $('#id-pms').val(id);
            $('#name-pms').text(name);

            $('.note-editable').attr('contenteditable', true)

        }

        $('#image_1').css('display', 'none')
        $('#image_2').css('display', 'none')
        $('#image_3').css('display', 'none')

        function previewImage_1() {
            $('#image_1').css('display', 'block')
            const image = $('#image1').get(0).files[0];

            if (image) {
                const reader = new FileReader();

                reader.onload = function() {
                    $('#image_1').attr('src', reader.result)
                }

                reader.readAsDataURL(image);
            }
        }

        function previewImage_2() {
            $('#image_2').css('display', 'block')
            const image = $('#image2').get(0).files[0];

            if (image) {
                const reader = new FileReader();

                reader.onload = function() {
                    $('#image_2').attr('src', reader.result)
                }

                reader.readAsDataURL(image);
            }
        }

        function previewImage_3() {
            $('#image_3').css('display', 'block')
            const image = $('#image3').get(0).files[0];

            if (image) {
                const reader = new FileReader();

                reader.onload = function() {
                    $('#image_3').attr('src', reader.result)
                }

                reader.readAsDataURL(image);
            }
        }

        function previewPMS(id) {
            $.ajax({
                type: 'GET',
                url: "{{ route('preview-pms') }}",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#name-pms-preview').text(response.group.name);
                    $('#img-1').attr('src', `/pms/${response.detail.image_1}`)
                    $('#img-2').attr('src', `/pms/${response.detail.image_2}`)
                    $('#img-3').attr('src', `/pms/${response.detail.image_3}`)
                    $('#date_action_preview').val(response.detail.date_action)
                    $('#action-pms-preview').summernote("code", response.detail.action)
                    $('.note-editable').attr('contenteditable', false)
                    console.log(response.group.name);
                }

            })
        }

        function editInventoryGroup(id, name) {
            $('#id').val();
            $('#name').val();

            $('#id').val(id);
            $('#name').val(name);
        }

        $(".selected-inventory").on('click', function() {
            var $box = $(this);
            if ($box.is(":checked")) {
                var group = ".selected-inventory[name='" + $box.attr("name") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });

        function previewItem(id_group) {
            $.ajax({
                type: "GET",
                url: "{{ route('list-inventory') }}",
                data: {
                    id_group: id_group
                },
                success: function(res) {
                    console.log(res);
                    $('.listInventory').html("")
                    var html = `
                    <table class="table table-striped w-100" id="table-listinventory">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle">No</th>
                                    <th rowspan="2" style="vertical-align: middle">Item</th>
                                    <th colspan="4" style="text-align:center">Inventory</th>
                                    <th rowspan="2" style="vertical-align: middle">Note</th>
                                </tr>
                                <tr>
                                    <th>Installed</th>
                                    <th>Used</th>
                                    <th>Reserved</th>
                                    <th>Ready Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                    `
                    for (let index = 0; index < res.length; index++) {
                        html += `
                        <tr>
                            <td>${index+1}</td>
                            <td>${res[index].item_code}-${res[index].part.name}</td>
                            <td>${(res[index].installed == null) ? 0 : res[index].installed}</td>
                            <td>${(res[index].used == null) ? 0 : res[index].used}</td>
                            <td>${(res[index].reserved == null) ? 0 : res[index].reserved}</td>
                            <td>${(res[index].ready == null) ? 0 : res[index].ready}</td>
                            <td>${res[index].note}</td>
                        </tr>
                        `;
                    }

                    html += `
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle">No</th>
                                    <th rowspan="2" style="vertical-align: middle">Item</th>
                                    <th>Installed</th>
                                    <th>Used</th>
                                    <th>Reserved</th>
                                    <th>Ready Stock</th>
                                </tr>
                                <tr>
                                    <th colspan="4" style="text-align:center">Inventory</th>
                                </tr>
                            </tfoot>
                        </table>
                    `

                    $('.listInventory').html(html)

                    $('#table-listinventory').DataTable({
                        responsive: true,
                    });
                }
            })
        }

        function editInventory(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('list-inventory') }}",
                data: {
                    id: id
                },
                success: function(res) {
                    console.log(res);
                    $('.editListInventory').html("")
                    var html = `
                    <table class="table table-striped w-100" id="table-editlistinventory">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle">Item</th>
                                    <th colspan="4" style="text-align:center">Inventory</th>
                                    <th rowspan="2" style="vertical-align:middle">Note</th>
                                </tr>
                                <tr>
                                    <th>Installed</th>
                                    <th>Used</th>
                                    <th>Reserved</th>
                                    <th>Ready Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                    `
                    // for (let index = 0; index < res.length; index++) {
                        html += `
                        <tr>

                            <td>
                                ${res.item_code}-${res.part.name}
                                <input type="text" name="id_item[]" class="d-none" value="${res.item_code}">
                            </td>
                            <td>
                                <input type="number" name="installed[]" class="form-control" value="${(res.installed == null) ? 0 : res.installed}">
                            </td>
                            <td>
                                <input type="number" name="used[]" class="form-control" value="${(res.used == null) ? 0 : res.used}">
                            </td>
                            <td>
                                <input type="number" name="reserved[]"" class="form-control" value="${(res.reserved == null) ? 0 : res.reserved}">
                            </td>
                            <td>
                                <input type="number" name="ready[]" class="form-control" value="${(res.ready == null) ? 0 : res.ready}">
                            </td>
                            <td>
                                <textarea class="form-control" name="note[]" rows="6">${res.note}</textarea>
                            </td>
                        </tr>
                        `;
                    // }

                    html += `
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle">Item</th>
                                    <th>Installed</th>
                                    <th>Used</th>
                                    <th>Reserved</th>
                                    <th>Ready Stock</th>
                                </tr>
                                <tr>
                                    <th colspan="4" style="text-align:center">Inventory</th>
                                </tr>
                            </tfoot>
                        </table>
                    `

                    $('.editListInventory').html(html)

                    // $('#table-editlistinventory').DataTable({
                    //     responsive: true,
                    // });
                }
            })
        }
    </script>
    @stack('group_inventory')

</body>

</html>
