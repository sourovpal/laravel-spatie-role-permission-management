 <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div class="user-details">
                        <div class="pull-left">
                            <img src="{{asset('/backend/images/users/avatar-1.jpg')}}" alt="" class="thumb-md img-circle">
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{ucwords($authUser->name)}} <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-settings-power"></i> Logout</a></li>
                                </ul>
                            </div>
                            <!-- auth user role show -->
                            <p class="text-muted m-0">
                                @foreach($authUser->roles as $authRole)
                                {{ucwords($authRole->name)}}
                                @break
                                @endforeach
                            </p>
                        </div>
                    </div>
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                            <li>
                                <a href="{{route('dashboard.home')}}" class="waves-effect active"><i class="md md-home"></i><span> Dashboard </span></a>
                            </li>
                            <!-- role menu condition -->
                            @if($authUser->can('role.view') 
                            || $authUser->can('role.create'))
                            <li class="has_sub">
                                <a href="#" class="waves-effect"><i class="md md-lock"></i><span> Roles & Permission </span><span class="pull-right"><i class="md md-add"></i></span></a>
                                <ul class="list-unstyled">
                                    @if($authUser->can('role.create'))
                                    <li><a href="{{route('dashboard.roles.create')}}">Create Role</a></li>
                                    @endif
                                    @if($authUser->can('role.view'))
                                    <li><a href="{{route('dashboard.roles.index')}}">View Roles</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            <!-- admin menu condition -->
                            @if($authUser->can('admin.view') 
                            || $authUser->can('admin.create'))
                            <li class="has_sub">
                                <a href="#" class="waves-effect"><i class="fa fa-users"></i><span> Users </span><span class="pull-right"><i class="md md-add"></i></span></a>
                                <ul class="list-unstyled">
                                    @if($authUser->can('admin.create'))
                                    <li><a href="{{route('dashboard.users.create')}}">Create User</a></li>
                                    @endif
                                    @if($authUser->can('admin.view'))
                                    <li><a href="{{route('dashboard.users.index')}}">View Users</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>