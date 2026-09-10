@extends('layouts.admin')

@section('title', 'Edit event — Joy In Zoe Administration')
@section('header', 'Edit event')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.events._form')
            </form>
        </div>
    </div>
@endsection
