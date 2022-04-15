@extends('backend.layouts.admin_master')
@section('title')
    Role Edit | Admin Panel
@endsection

@section('content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Role Edit</h4>

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
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('roles.update', $roleEdit->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name='name' value="{{ $roleEdit->name }}">
                                @error('name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="slug" class="form-control" name='slug' value="{{ $roleEdit->slug }}">
                                @error('slug')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="role_permissions">Add Permissions</label>
                                <input type="role_permissions" class="form-control" name='role_permissions' value="">
                                @error('role_permissions')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection
