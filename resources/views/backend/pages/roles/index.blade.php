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
            <h4 class="pull-left page-title">All Roles & Permissions </h4>
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
                        <a href="{{route('dashboard.roles.create')}}" id="addToTable" class="btn btn-primary waves-effect waves-light" style="vertical-align: revert;"><i class="fa fa-plus"></i> Create Role</a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped" id="datatable-editable">
                <thead>
                    <tr>
                        <th width="10%">SL</th>
                        <th width="15%">Role Name</th>
                        <th width="60%">Permissions</th>
                        <th width="15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr class="gradeX">
                        <td>{{$loop->index+1}}</td>
                        <td>{{ucwords($role->name)}}</td>
                        <td class="d-flex">
                            @php
                                $permi_col = [];
                            @endphp
                            <ul class="permissions" style="list-style:square;">
                                 @foreach($role->permissions as $permission)
                                    @if(($loop->index % 2) == 0)
                                        <li class="mx-4"><span>{{$permission->name}}</span></li>
                                    @else
                                        @php
                                            $permi_col[] = $permission->name;
                                        @endphp
                                    @endif
                                 @endforeach
                            </ul>
                            <ul class="permission" style="list-style:square;">
                                @foreach($permi_col as $permi)
                                    <li class="mx-4"><span>{{$permi}}</span></li>
                                 @endforeach
                            </ul>
                        </td>
                        <td class="actions">
                            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                            <form id="delete_role_form_{{$role->id}}" method="post" action="{{route('dashboard.roles.destroy', $role->id)}}">
                                @csrf @method('DELETE')
                            <a href="{{route('dashboard.roles.edit', $role->id)}}" class="on-default edit-row"><i class="fa fa-edit"></i></a>
                            <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure delete {{$role->name}} Role')){document.getElementById('delete_role_form_{{$role->id}}').submit()};" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
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