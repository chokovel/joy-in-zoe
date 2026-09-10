@extends('layouts.admin')

@section('title', 'Edit gallery category — Joy In Zoe Administration')
@section('header', 'Edit gallery category')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.gallery-categories.update', $category) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.gallery-categories._form')
            </form>
        </div>
    </div>
@endsection
