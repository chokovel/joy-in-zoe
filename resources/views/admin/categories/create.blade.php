@extends('layouts.admin')

@section('title', 'New category — Joy In Zoe Administration')
@section('header', 'New category')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                @include('admin.categories._form')
            </form>
        </div>
    </div>
@endsection
