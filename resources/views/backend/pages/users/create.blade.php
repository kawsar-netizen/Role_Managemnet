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
                                -------------------
                            </div>
                            <div id="permissions_box">
                                ------------------------------------
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
