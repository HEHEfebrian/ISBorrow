@extends('layouts.app')

@section('title', 'ISBorrow | Information System for Business')

@section('content')

    {{-- Hero Section --}}
    @include('partials.hero')

    {{-- Features --}}
    @include('partials.features')

    {{-- How It Works --}}
    @include('partials.how-it-works')

    {{-- Statistics --}}
    @include('partials.statistics')

    {{-- Call To Action --}}
    @include('partials.cta')

@endsection
