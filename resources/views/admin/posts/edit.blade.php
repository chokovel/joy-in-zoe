@extends('layouts.admin')

@section('title', 'Edit post — Joy In Zoe Administration')
@section('header', 'Edit post')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.posts._form')
            </form>
        </div>
    </div>
@endsection
