@extends('layouts.admin')

@section('title', 'New post — Joy In Zoe Administration')
@section('header', 'New post')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                @include('admin.posts._form')
            </form>
        </div>
    </div>
@endsection
