@extends('layouts.admin')

@section('title', 'Upload image — Joy In Zoe Administration')
@section('header', 'Upload image')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.gallery-images.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.gallery-images._form')
            </form>
        </div>
    </div>
@endsection
