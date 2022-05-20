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
            <h4 class="pull-left page-title">Create Roles & Permissions </h4>
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
                        <a href="{{route('dashboard.roles.index')}}" id="addToTable" class="btn btn-primary waves-effect waves-light" style="vertical-align: revert;"><i class="md md-lock"></i> View Roles</a>
                    </div>
                </div>
            </div>
            <div>
                <form method="post" action="{{route('dashboard.roles.store')}}">
                    @csrf
                    <div class="form-group">
                        <label>Role Name</label>
                        <input class="form-control" type="text" name="name" placeholder="Enter Role Name" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label>Permissions</label>
                        <hr>
                        <div class="form-group">
                            <input type="checkbox" name="" id="allSelectPermission">
                            <label for="allSelectPermission">All</label>
                        </div>
                        @foreach($permissions_group as $group)
                        @php
                            $permissions = \App\Models\CustomData::getPermissionGroupByName($group->group_name);
                        @endphp
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <input class="permission_group" id="permission_group_{{$group->group_name}}" type="checkbox" name="" data-group_name="{{$group->group_name}}">
                                    <label for="permission_group_{{$group->group_name}}">{{$group->group_name}}</label>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                @foreach($permissions as $permission)
                                <div class="form-input">
                                    <input class="permission_item {{$group->group_name}}" id="{{$permission->name}}" type="checkbox" name="permissions[]" data-group_name="{{$group->group_name}}" value="{{$permission->id}}">
                                    <label for="{{$permission->name}}">{{$permission->name}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div><br>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary rounded-0">Save Role</button>
                    </div>
                </form>
            </div>

        </div>
    <!-- end: page -->
    </div> <!-- end Panel -->

@endsection

<!-- custom js section area -->
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        // checked permission item
        $('.permission_item').click(function(){
            var group_name = $(this).data('group_name');
            if($('.'+group_name).length == $('.'+group_name+':checked').length)
            {
                $('#permission_group_'+group_name).prop('checked', true);
            }
            else
            {
                $('#permission_group_'+group_name).prop('checked', false);
            }
            selectGroupCheckedAllInput();
        });
        // checked permission group 
        $('.permission_group').click(function(){
            var group_name = $(this).data('group_name');
            if($(this).is(':checked'))
            {
                $('.'+group_name).prop('checked', true);
            }
            else
            {
                $('.'+group_name).prop('checked', false);
            }
            selectGroupCheckedAllInput();
        });
        // check permission all
        $('#allSelectPermission').click(function(){
            if($(this).is(':checked'))
            {
                $('.permission_group').prop('checked', true);
                $('.permission_item').prop('checked', true);
            }
            else
            {
                $('.permission_group').prop('checked', false);
                $('.permission_item').prop('checked', false);
            }
        });
        // check all group and permission and (all check button)
        function selectGroupCheckedAllInput()
        {
             if($('.permission_group').length == $('.permission_group:checked').length)
            {
                $('#allSelectPermission').prop('checked', true);
            }
            else
            {
                $('#allSelectPermission').prop('checked', false);
            }
        }

    });
</script>

@endsection