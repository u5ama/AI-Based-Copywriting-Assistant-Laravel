@extends('layouts/dashboard_ts')
@section('content')
<div class="row breadcrumbs">
        <div class="col-12"><a href="/template">Dashboard</a> <span class="dot-seprator">●</span> <span>Team Members</span></div>
    </div>
    <style>
    .fkyVgZ{background-color:#FC6501;padding:10px 40px;border:medium none;border-radius:34px;box-shadow:rgba(83,92,165,0.2) 0 1px 2px 2px;color:#fff;font-size:20px;margin-top:30px}
    .btn{border-radius:44px}
    .fa{color:#f35d5d;font-size:17px;padding:10px;border-radius:5px}
    .fa:hover{color:#000;padding:10px;background-color:#f3f7f9}
    .tooltip-inner{background-color:#fb8231}
    a.btn.btn-success.btn-block.ts-f-btn{width:150px;line-height:36px;font-weight:600}
    a.btn.btn-success.btn-block.ts-f-btn.red-tooltip{background:#f3f7f9;color:#5c646f!important;margin-top:0;margin-left:15px}
    .align-item{display:flex;align-items:center}
    .bs-tooltip-auto[x-placement^=top] .arrow::before,.bs-tooltip-top .arrow::before{border-top-color:#fb8e45}
    @media(max-width:767px) {
    .align-item{margin-top:15px}
    .table-auto{width:100%;overflow:auto}
    .table-auto table{overflow:auto;width:500px}
    .card{height:auto!important}}
    .card-member {
        background-color: #ffffff96;
        box-shadow: 0 0 6px 0 #00000042;
        border: 0;
        display: flex;
        overflow: hidden;
        padding: 2rem;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-start;
        border-radius: 1.25rem;
        transition: background-color 0.2s, box-shadow 0.2s;
        text-align: left;
    }
    </style>
<!-- Form row -->
<div class="row" style="margin-top: 3%;">
    <div class="col-12">
     @if(session()->has('msg'))
     <div class="alert alert-success">
      {{ session()->get('msg') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<br>
<div class="card-member bg-pattern ts-radius ts-form">
    <div class="card-body w-full">
    <div class="auth-logo">Team Members</div>
        <br>
        {{--{{dd(auth()->user())}}--}}
        @if (auth()->user()->linked_user_role == 'user')
            <div class="row">
                <div class="col-md-9">
                    <a href="#" title="Only team owner can send member invitation." data-toggle="tooltip" data-placement="top" class="btn btn-light red-tooltip"><i class="fas fa-times"></i> Only team owner can send member invitation</a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-6">
                    <input type="text" id="myInput" readonly="" name="link" value="{{route('register') }}?ref={{$userR->linkout}}" class="form-control">
                </div>
                <div class="col-md-3 align-item">
                    @if(count($refers)>=10)
                        <a href="#" class="btn btn-success btn-block ts-f-btn" onclick="alert('You can add max 10 members!');">Share Url</a>
                    @else
                        <a href="#" class="btn btn-success btn-block ts-f-btn" onclick="share();"><i class="fas fa-copy"></i> Copy Link</a>
                        <a href="#" title="The existing link will be deactivated." data-toggle="tooltip" data-placement="top" class="btn btn-success btn-block ts-f-btn red-tooltip" onclick="reset('{{$userR->id}}');"><i class="fas fa-sync-alt"></i> Reset Link</a>
                    @endif

                </div>
            </div>
        @endif
        <br>
        <div class="table-auto">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    {{--<th>Signup at</th>--}}
                    @if($userR->linked_user_role =='admin' )
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if(count($refers)>0)
                @foreach($refers as $key=> $ref)
                <tr>
                    <form method="post" action="update/members/{{$ref->user_id}}" id="preview_form">
                        @csrf
                        <td>{{$key+1}}</td>
                        <td>{{$ref->username}}</td>
                        <td>{{$ref->email}}</td>
                        <td>
                            @if($userR->linked_user_role =='user')
                            <span class="badge badge-success">{{$ref->linked_user_role}}</span>
                            @else
                                <span class="badge badge-success">{{$ref->linked_user_role}}</span>
                            {{--<select name="linked_user_role" class="form-control" id="user_role" onchange="change_status('{{$ref->user_id}}');">
                                <option value="admin" @if($ref->linked_user_role=='admin') selected @endif)>Admin</option>
                                <option value="user" @if($ref->linked_user_role=='user') selected @endif>User</option>
                            </select>--}}
                            @endif
                        </td>
                        {{-- <td>{{$ref->created_at->toFormattedDateString()}}</td> --}}
                        @if($userR->linked_user_role =='admin' )

                            <td>
                                @if($ref->linked_user_role != 'admin')
                                    <a href="#" onclick="removeUser('{{$ref->id}}')" class="btn"><i class="fa fa-trash"></i></a>
                                @endif
                        </td>
                        @endif
                    </form>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
</div>
    </div> <!-- end card-body -->
</div> <!-- end card-->
</div> <!-- end col -->
</div>
<!-- end row -->

<script type="text/javascript">
    function share(argument) {
        var copyText = document.getElementById("myInput");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");

        Swal.fire(
            'Copied!',
            'Link has been Copied.',
            'success'
        );
    }



    function removeUser(user) {
     var txt;
     var r = confirm("Are you sure you want to delete?");
     if (r == true) {

        /* alert(user);
        return false;*/
        $.ajax({

            url: 'delete/member/'+user,
            type: "get",
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,

            beforeSend: function(){

            },
            success: function (data) {

              Swal.fire(
                  'Updated!',
                  'Link has been updated.',
                  'success'
                );
              location.reload();
          },
          error:(function(error) {
              alert("Something went wrong");
          })

      });
    }
}

function change_status(argument) {
    var user_role=$('#user_role').val();
    var datastring = $("#preview_form").serialize();
    console.log(datastring);
     $.ajax({

            url: 'update/members/'+argument,
            type: "post",

             data: datastring,

            beforeSend: function(){

            },
            success: function (data) {
            Swal.fire({
                icon: 'success',
                title: 'Status Has been updated',
                showConfirmButton: false,
                timer: 1500
            })

          },
          error:(function(error) {
              alert("Something went wrong");
          })

      });
}

function reset(argument) {
        Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, reset it!'
    }).then((result) => {
      if (result.isConfirmed) {


         $.ajax({

            url: 'update/link/'+argument,
            type: "get",
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,

            beforeSend: function(){

            },
            success: function (data) {

              Swal.fire(
                  'Updated!',
                  'Link has been updated.',
                  'success'
                );
              location.reload();
          },
          error:(function(error) {
              alert("Something went wrong");
          })

      });
      }
    });
}

</script>


@endsection
