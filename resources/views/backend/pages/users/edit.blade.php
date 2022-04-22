@extends('backend.layouts.admin_master')
@section('title')
    User Edit | Admin Panel
@endsection

@section('content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">User Edit</h4>

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
                        <form action="{{ route('users.update', $userEdit->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name='name' value="{{ $userEdit->name }}">
                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name='email' value="{{ $userEdit->email }}">
                                @error('email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name='password' placeholder="password...">
                            </div>
                            <div class="form-group">
                                <label for="confrom-password">Confrom Password</label>
                                <input type="password" class="form-control" name='password_confirmation'
                                    placeholder="password...">
                            </div>
                            <div class="form-group">
                                <label for="role">Select Role</label>
                                <select name="role" id="role" class="role form-control">
                                    <option value="">--- Select Role ---</option>
                                    @foreach ($roles as $item)
                                        <option data-role-id="{{ $item->id }}" data-role-slug="{{ $item->slug }}"
                                            value="{{ $item->id }}"
                                            {{ $userEdit->roles->isEmpty() || $item->name != $userRole->name ? '' : 'selected' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="permissions_box">
                                <label for="roles">Select Permisstions</label>
                                <div id="permissions_checkbox_list">

                                </div>
                                @if ($userEdit->permissions->isNotEmpty())
                                    <div id="user_permissions_box">
                                        <label for="roles">User Permissions</label>
                                        <div id="user_permissions_checkbox_list">
                                            @foreach ($rolePermissions as $permission)
                                                <div class="custom-control-input custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="permissions[]"
                                                        id="{{ $permission->slug }}" value="{{ $permission->id }}"
                                                        {{ in_array($permission->id,$userPermissions->pluck('id')->toArray()) ? 'checked."checked"' : '' }}>
                                                        <label class="custom-control-label" for="{{$permission->slug}}">{{$permission->name}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
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

@section('js_user_page')
    <script>
        $(document).ready(function() {
            var permissions_box = $('#permissions_box');
            var permissions_checkbox_list = $('#permissions_checkbox_list');
            var user_permissions_box = $('#user_permissions_box');
            var user_permissions_checkbox_list = $('#user_permissions_checkbox_list');
            permissions_box.hide();

            $('#role').on('change', function() {
                var role = $(this).find(':selected');
                var role_id = role.data('role-id');
                var role_slug = role.data('role-slug');

                permissions_checkbox_list.empty();
                user_permissions_box.empty();

                $.ajax({
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
                            '<input class="custom-control-input" type="checkbox" name="permissions[]" id="' +
                            element.slug + '" value="' + element.id + '">' +
                            '<label class="custom-control-label" for="' + element
                            .slug + '">' + element.name + '</label>' +
                            '</div>'
                        );
                    });
                });
            });
        });
    </script>
@endsection
