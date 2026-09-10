@extends('layouts.admin')

@section('title', 'New event — Joy In Zoe Administration')
@section('header', 'New event')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.events._form')
            </form>
        </div>
    </div>
@endsection
