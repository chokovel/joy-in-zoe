@extends('layouts.admin')

@section('title', 'Manager Dashboard — Joy In Zoe Intercessory Ministries')
@section('header', 'Manager Dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Welcome back, {{ $user->name }}</h5>
            <p class="card-text mb-0">
                This is your ministry content area. Manage blog posts, prayers, gallery, events, and other ministry content from here.
            </p>
        </div>
    </div>
@endsection
