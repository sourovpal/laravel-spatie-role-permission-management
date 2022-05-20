@php
    $authUser = Auth::guard('admin')->user();
@endphp
<!DOCTYPE html>
<html>
    <head>
        <!-- meta tag include -->
        @include('backend.layouts.assets.meta')
        <!-- page title -->
        <title>@yield('pagetitle', 'Dashboard')</title>
        <!-- css link include -->
        @include('backend.layouts.assets.style')
        <!-- custom css -->
        @yield('style')
    </head>



    <body class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
            @include('backend.layouts.assets.header')
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            @include('backend.layouts.assets.sidebar')
           
            <!-- Left Sidebar End --> 



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                       @yield('content')

                    </div> <!-- container -->
                               
                </div> <!-- content -->

                    <!-- footer page include -->
                @include('backend.layouts.assets.footer')

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- script file include -->
        @include('backend.layouts.assets.script')
        <!-- custom js -->
        @yield('script')
    </body>
</html>