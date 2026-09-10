@extends('layouts.app')

@section('title', 'Joy In Zoe Intercessory Ministries — Reaching the Unreached Through Prayer and Outreach')
@section('meta_description', 'Joy In Zoe Intercessory Ministries is a Spirit-breathed intercessory movement restoring prayer altars, raising women intercessors, and reaching the unreached through prayer and outreach.')

@section('content')
    @include('home.hero')
    @include('home.about')
    @include('home.youtube')
    @include('home.mission')
    @include('home.prayer')
    @include('home.events')
    @include('home.preview')
    @include('home.testimonies')
    @include('home.join')
    @include('home.blog')
@endsection
