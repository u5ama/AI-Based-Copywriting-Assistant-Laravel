@extends('layouts/dashboard_ts')
@section('content')
    <div id="app">
        <docview :doc-data="{{$docData}}"/>
    </div>
@endsection
