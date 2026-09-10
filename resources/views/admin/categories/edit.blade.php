@extends('layouts.admin')

@section('title', 'Edit category — Joy In Zoe Administration')
@section('header', 'Edit category')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                @csrf
                @method('PUT')
                @include('admin.categories._form')
            </form>
        </div>
    </div>
@endsection
