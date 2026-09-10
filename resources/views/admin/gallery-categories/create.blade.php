@extends('layouts.admin')

@section('title', 'New gallery category — Joy In Zoe Administration')
@section('header', 'New gallery category')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.gallery-categories.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.gallery-categories._form')
            </form>
        </div>
    </div>
@endsection
