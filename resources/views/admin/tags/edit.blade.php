@extends('layouts.admin')

@section('title', 'Edit tag — Joy In Zoe Administration')
@section('header', 'Edit tag')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.tags.update', $tag) }}">
                @csrf
                @method('PUT')
                @include('admin.tags._form')
            </form>
        </div>
    </div>
@endsection
