@extends('backend.layouts.admin_master')
@section('title')
    User Show | Admin Panel
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Name: {{ $userShow->name }}</h3>
                <h4>Email: {{ $userShow->email }}</h4>
                <h4>Number of Posts:-----</h4>
            </div>
            <div class="card-body">
                <h5 class="card-title">Role</h5>
                <p class="card-text">
                    -------
                </p>
                <h5 class="card-title">Permissions</h5>
                <p class="card-text">
                    -------
                </p>
            </div>
            <div class="card-footer">
                <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Go Back</a>
            </div>
        </div>
    </div>
@endsection