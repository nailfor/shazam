@extends('vendor.shazam.layouts.app')

@section('javascript')
    window.user = @json($user);
    window.references = @json($references);
@endsection

@section('header')
<script type="module" src="/js/app.js"></script>
@endsection

@section('content')
    <div id="app">
        Install UI first.
    </div>
@endsection
