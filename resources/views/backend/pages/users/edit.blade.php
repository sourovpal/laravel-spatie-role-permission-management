    @extends('backend.layouts.master')

    @section('pagetitle', 'Dashboard-Roles')

    <!-- custom css section area -->
    @section('style')
    <style type="text/css">
        .d-flex{display:flex;}
        .flex-wrap{flex-wrap:wrap;}
        .mx-4{margin:0px 1.25rem;}
        .permissions li span{text-transform:capitalize;}
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection

    @section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Create User</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="#">Moltran</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div>
    </div>
    <!-- role view data table  -->
     <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="m-b-30 ">
                        <a href="{{route('dashboard.users.index')}}" id="addToTable" class="btn btn-primary waves-effect waves-light" style="vertical-align: revert;"><i class="fa fa-users"></i> View Users</a>
                    </div>
                </div>
            </div>
            <div>
                <form method="post" action="{{route('dashboard.users.update', $user->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Enter Name" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" name="email" placeholder="Enter Email" value="{{$user->email}}">
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" type="text" name="username" placeholder="Enter Username" value="{{$user->username}}">
                            </div>
                            <div class="form-group">
                                <label>Assien Role</label>
                                <select class="form-control select2" multiple="" name="roles[]" size="3">
                                    @foreach($roles as $role)
                                    <option {{$user->hasRole($role->name) ? 'selected' : ''}} value="{{$role->name}}">{{ucwords($role->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary rounded-0">Save User</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    <!-- end: page -->
    </div> <!-- end Panel -->

@endsection

<!-- custom js section area -->
@section('script')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    (function($){
        $('.select2').select2();
    })(jQuery);
</script>
@endsection