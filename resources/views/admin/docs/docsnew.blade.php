@extends('layouts/dashboard_ts')
@section('content')
    <div class="no-side-menu" id="app">
        <div class="d-flex justify-content-between" style="margin: 21px 0px 0px 28px;">
            <h3><b>How would you like to start?</b></h3>
            <div class="form-group search-main">
                <a href="#" data-toggle="modal" data-target="#request_template">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-50"><path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z"></path></svg>
                    Request a template
                </a>
                <input type="text" v-model="searchTool" class="form-control" placeholder="Search">
            </div>
        </div>
       <div class="container ">
           <div class="row">
               <div class="col-lg-4 offset-lg-2 col-md-6 col-sm-12 mb-sm-5 " style="padding: 10px;">
                   <a href="{{ url('/docscreate') }}">
                       <div class=" ">
                           <div class="sc-dRPiIx esbyIi new-docs-box">
                               <div class=" mx-auto d-block p-4" style="border: 1px solid black;  border-radius: 10px">
                                   <h4 style="text-align: left; font-weight: 600;" class="text-center d-flex justify-content-center">
                                       <img class="img-fluid" src="../../../../assets/admin/images/book.svg"  >
                                   </h4>
                                   <h5 class="text-center">Start from scratch</h5>
                               </div>
                           </div>
                       </div>
                   </a>
               </div>
               <div class="col-lg-4 new-docs-box col-md-6 col-sm-12" style="border: none !important; padding: 10px;">
                   <a href="{{ url('') }}">
                       <div class="">
                           <div class="sc-dRPiIx esbyIi new-docs-box ">
                               <div class=" mx-auto d-block p-4" style="border: 1px solid black; border-radius: 10px">
                                   <h4 style="text-align: left; font-weight: 600;" class="text-center d-flex justify-content-center">
                                       <img class="img-fluid" src="../../../../assets/admin/images/pen.svg">
                                   </h4>
                                   <h5 class="text-center">Blog post workflow</h5>
                               </div>
                           </div>
                       </div>
                   </a>
               </div>
           </div>
       </div>
    </div>

@endsection
