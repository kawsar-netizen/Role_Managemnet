@extends('backend.layouts.admin_master')
@section('title')
    Role Create | Admin Panel
@endsection
@section('css_role_page')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-tagsinput.css') }}">
@endsection
@section('content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Role Create</h4>
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
                        <h4 class="header-title">Create New Role</h4>
                        @include('backend.partials.message')
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input type="text" class="form-control" id="role_name" name='name'
                                    placeholder="Enter role name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="slug">Role Slug</label>
                                <input type="text" class="form-control" tag="role_slug" name='slug' id="role_slug"
                                    placeholder="Enter role slug" value="{{ old('slug') }}">
                            </div>
                            <div class="form-group">
                                <label for="roles_permissions">Add Permission</label>
                                <input type="text" class="form-control" name='roles_permissions' data-role="tagsinput"
                                    placeholder="Enter role permission" value="{{ old('roles_permissions') }}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Add</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection
@section('js_role_page')
    <script src="{{ asset('assets/js/bootstrap-tagsinput.js') }}"></script>

    {{-- make slug script tag code --}}

    <script>
        $('document').ready(function() {
            $('#role_name').keyup(function(e) {
                var str = $('#role_name').val();
                str = str.replace(/\W+(?!$)/g, '-').toLowerCase();
                $('#role_slug').val(str);
                $('#role_slug').attr('placeholder', str);
            });
        });
    </script>
@endsection
