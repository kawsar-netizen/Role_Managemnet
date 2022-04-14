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
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection
