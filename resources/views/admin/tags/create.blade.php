@extends('layouts.admin')

@section('title', 'New tag — Joy In Zoe Administration')
@section('header', 'New tag')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.tags.store') }}">
                @csrf
                @include('admin.tags._form')
            </form>
        </div>
    </div>
@endsection
