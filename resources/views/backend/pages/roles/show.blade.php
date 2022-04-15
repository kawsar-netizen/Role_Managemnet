@extends('backend.layouts.admin_master')
@section('title')
    Role Show | Admin Panel
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Name: {{ $roleShow->name }}</h3>
                <h4>Slug: {{ $roleShow->slug }}</h4>
            </div>
            <div class="card-body">
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
