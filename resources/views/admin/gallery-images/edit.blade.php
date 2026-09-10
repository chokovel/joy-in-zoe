@extends('layouts.admin')

@section('title', 'Edit image — Joy In Zoe Administration')
@section('header', 'Edit image')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.gallery-images.update', $image) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.gallery-images._form')
            </form>
        </div>
    </div>
@endsection
