@extends('layouts/dashboard_ts')
@section('content')
    <div class="no-side-menu" id="app">

        <div class="d-flex justify-content-between" style="margin: 21px 0px 0px 28px;">
            <h2><b>Start a New Documents</b></h2>
            <div class="form-group search-main">
                <a href="#" data-toggle="modal" data-target="#request_template">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-50"><path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z"></path></svg>
                    Request a template
                </a>
                <input type="text" v-model="searchTool" class="form-control" placeholder="Search">
            </div>
        </div>

    <doclisting/>

    </div>
@endsection
