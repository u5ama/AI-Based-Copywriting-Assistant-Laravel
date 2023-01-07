@extends('layouts/dashboard_ts')
@section('content')
<div class="no-side-menu" id="app">
    <div class="banner-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-image">
                    <h3>Welcome, {{ ucfirst($user['username']) }}</h3>
                    <p>What do you want to write today?</p>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between" style="margin: 21px 0px 0px 28px;">
        <h4><b>Browse</b></h4>
        <div class="form-group search-main">
            <a href="#" data-toggle="modal" data-target="#request_template">
                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-50"><path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z"></path></svg>
                Request a template
            </a>
            <input type="text" v-model="searchTool" class="form-control" placeholder="Search">
        </div>
    </div>
    <Content-Tools :tools="{{$tools}}" :search="searchTool" ></Content-Tools>
   {{-- <div class="row cards-body">
        <div v-for="tool in searchTools(tools)" class="col-lg-3">
            <a :href="tool.url">
                <div class="sc-iWFSnp cmuvkJ">
                    <div class="sc-dRPiIx esbyIi">
                        <div class="dash-ln">
                        <h4 style="text-align: left; font-weight: 600; margin-left: 9px;">
                            <img class="img-fluid" :src="tool.image" alt="facebook.png">
                        </h4>
                        <h4> @{{ tool.name }} </h4>
                        </div>
                        <p>@{{ tool.description }} </p>
                    </div>
                </div>
            </a>
        </div>

    </div>--}}
</div>

<div class="modal" id="request_template" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body ts-radius ts-form p-4">
            <form role="dialog" id="request-template-form" action="#" aria-modal="true" aria-labelledby="modal-headline" class="p-6 transition-all transform bg-white rounded-lg shadow-xl pointer-events-auto sm:max-w-xl sm:w-full sm:p-6">
                <div class="w-full text-left">
                <div class="auth-logo mb-2"> Request a new template </div>
                    <p class="text-sm font-medium text-gray-500">
                    Would you like to see any new tools added to TypeSkip? Send us your suggestions below (Please be as detailed as possible).
                    </p>
                    <!---->
                    <div>
                        @csrf
                        <label for="message-text" class="block font-medium leading-5 text-gray-700"> Message <!----></label>
                        <div class="rounded-md shadow-sm">
                            <textarea id="message-text" name="message" rows="4" required="required" autocomplete="off" placeholder="Please write your message" class="form-control d-block w-full form-input message-text "></textarea>
                        </div>
                    </div>
                </div>
                <div class="textbox-margin text-right">
                    <button type="button" class="btn ts-f-btn mr-2 template-request">Submit</button>
                    <button type="button" class="btn ts-f-btn-white" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection
