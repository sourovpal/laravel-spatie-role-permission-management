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
    @endsection

    @section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">All Users </h4>
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
                        <a href="{{route('dashboard.users.create')}}" id="addToTable" class="btn btn-primary waves-effect waves-light" style="vertical-align: revert;"><i class="fa fa-plus"></i> Create User</a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped" id="datatable-editable">
                <thead>
                    <tr>
                        <th width="5%">SL</th>
                        <th width="20%">Name</th>
                        <th width="15%">Username</th>
                        <th width="20%">Email</th>
                        <th width="25%">Role</th>
                        <th width="15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="gradeX">
                        <td>{{$loop->index+1}}</td>
                        <td>{{ucwords($user->name)}}</td>
                        <td class="">{{($user->username)}}</td>
                        <td class="">{{$user->email}}</td>
                        <td class="">
                                @foreach($user->roles as $role)
                                <a>{{ucwords($role->name)}}</a>
                                @if(!$loop->last)
                                &
                                @endif
                                @endforeach
                        </td>
                        <td class="actions">
                            <form id="delete_role_form_{{$user->id}}" method="post" action="{{route('dashboard.roles.destroy', $user->id)}}">
                                @csrf @method('DELETE')
                            <a href="{{route('dashboard.users.edit', $user->id)}}" class="on-default edit-row"><i class="fa fa-edit"></i></a>
                            <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure delete {{$user->name}}')){document.getElementById('delete_role_form_{{$user->id}}').submit()};" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    <!-- end: page -->
    </div> <!-- end Panel -->

@endsection

<!-- custom js section area -->
@section('script')
<script type="text/javascript">

</script>


@endsection