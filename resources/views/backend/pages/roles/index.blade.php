@extends('backend.layouts.admin_master')
@section('title')
    Role List | Admin Panel
@endsection
@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection
@section('content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Roles</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><span>All Roles</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                @include('backend.partials.logout')
            </div>
        </div>
    </div>
    <!-- page title area end -->
    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="header-title">Role List</h4> --}}
                        <a href="{{ route('roles.create') }}">
                            <button type="button" class="btn btn-primary mb-5">Create New Role</button>
                        </a>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Permission</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td>
                                                @if ($item->permissions != null)
                                                    @foreach ($item->permissions as $permission)
                                                        <span class=" badge badge-info">
                                                            {{ $permission->name }}
                                                        </span>
                                                    @endforeach   
                                                @endif
                                            </td>
                                            <th>
                                                <form action="{{ route('roles.destroy', $item->id) }}" method="post">
                                                    <a href="{{ route('roles.show', $item->id) }}"><button type="button"
                                                            class="btn-xs btn btn-success"><i
                                                                class="fa fa-eye"></i></i></button>
                                                    </a>
                                                    <a href="{{ route('roles.edit', $item->id) }}"><button type="button"
                                                            class="btn-xs btn btn-primary"><i
                                                                class="fa fa-edit"></i></button>
                                                    </a>
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn-xs btn btn-danger" type="submit"
                                                        onclick="return confirm('Are You Sure To Deleted !')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Permission</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection
@section('scripts')
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        /*================================
                        datatable active
                        ==================================*/
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }
        if ($('#dataTable2').length) {
            $('#dataTable2').DataTable({
                responsive: true
            });
        }
        if ($('#dataTable3').length) {
            $('#dataTable3').DataTable({
                responsive: true
            });
        }
    </script>
@endsection
