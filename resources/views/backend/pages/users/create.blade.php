@extends('backend.layouts.admin_master')
@section('title')
    User Create | Admin Panel
@endsection

@section('content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">User Create</h4>

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
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name='name' placeholder="Name..."
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name='email' placeholder="Email..."
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name='password' placeholder="password..."
                                    required minlength="8">
                                @error('password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confrom Password</label>
                                <input type="password" class="form-control" name='password_confirmation'
                                    placeholder="password...">
                                @error('password_confirmation')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role">Select Role</label>
                                <select name="roel" id="role" class="role form-control">
                                    <option value="">--- Select Role ---</option>
                                    @foreach ($all_role as $item)
                                        <option data-role-id="{{ $item->id }}" data-role-slug="{{ $item->slug }}"
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="permissions_box">
                                <label for="roles">Select Permisstions</label>
                                <div id="permissions_checkbox_list">

                                </div>
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

@section('js_user_page')
    <script>
        $(document).ready(function() {
            var permissions_box = $('#permissions_box');
            var permissions_checkbox_list = $('#permissions_checkbox_list');
            permissions_box.hide();

            $('#role').on('change', function() {
                var role = $(this).find(':selected');
                var role_id = role.data('role-id');
                var role_slug = role.data('role-slug');

                $ajax({
                    'url': '/users/create',
                    'method': 'get',
                    'dataType': 'json',
                    data: {
                        role_id: role_id,
                        role_slug: role_slug,
                    }
                }).done(function(data) {
                    console.log(data);
                    permissions_box.show();

                    $.each(data, function(index, element) {
                        $(permissions_checkbox_list).append(
                            '<div class="custom-control custom-checkbox">' +
                            '<input class="custom-control-input" type="checkbox" name="permissions[]">'
                            '</div>'
                        );
                    });
                });
            });
        });
    </script>
@endsection
