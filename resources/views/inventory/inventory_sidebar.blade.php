<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
                <h4>Trading Portal</h4>
               <!-- <img height="30" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" title="Span Floor">  -->
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->segment(1);
        $segment2 = request()->segment(2);
    @endphp
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment2 == 'dashboard') ? 'active' : '' }}">
                    <a href="{{url('/dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>

               
                
                @can('category_lists')
                <div class="nav-item {{ ($segment1 == 'categories') ? 'active open' : '' }} has-sub">
                <a href="#"><i class="ik ik-headphones"></i><span>{{ __('Categories')}}</span></a>
                    <div class="submenu-content">
                        @can('category_lists')
                    <a href="{{url('categories')}}" class="menu-item {{ ($segment1 == 'categories' && $segment2 == '') ? 'active' : '' }}">{{ __('List Categories')}}</a>
                    @endcan
                    @can('category_add')
                    <a href="{{url('categories')}}" class="menu-item {{ ($segment1 == 'categories' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Category')}}</a>            @endcan          
                    </div>
                </div>
                @endcan
                
                 @can('enquiry_lists')
                <div class="nav-item {{ ( $segment1 == 'enquiry') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-headphones"></i><span>{{ __('Enquiry')}}</span></a>
                    <div class="submenu-content">
                         @can('enquiry_lists')
                    <a href="{{url('enquiry')}}" class="menu-item {{ ($segment1 == 'enquiry' && $segment2 == '') ? 'active' : '' }}">{{ __('List Enquiries')}}</a>
                    @endcan
                    @can('enquiry_add')
                        <a href="{{url('enquiry/create')}}" class="menu-item {{ ($segment1 == 'enquiry' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Enquiry')}}</a>
                       @endcan
                    </div>
                </div>
                @endcan

                @can('product_lists')
                <div class="nav-item {{ ( $segment1 == 'items') ? 'active open' : '' }} has-sub">
                    
                    <a href="#"><i class="ik ik-headphones"></i><span>{{ __('Products')}}</span></a>
                    <div class="submenu-content">
                        @can('product_lists')
                    <a href="{{url('items')}}" class="menu-item {{ ($segment1 == 'items' && $segment2 == '') ? 'active' : '' }}">{{ __('List Products')}}</a>
                    @endcan
                    @can('product_add')
                        <a href="{{url('items/create')}}" class="menu-item {{ ($segment1 == 'items' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Products')}}</a>
                         @endcan
                    </div>
                </div>
                @endcan
                
                @can('supply_lists')
                <div class="nav-item {{ ( $segment1 == 'vendor') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Supply Partner')}}</span></a>
                    <div class="submenu-content">
                        @can('supply_lists')
                        <a href="{{url('vendor')}}" class="menu-item {{ ($segment1 == 'vendor' && $segment2 == '') ? 'active' : '' }}">{{ __('List Supply Partner')}}</a>
                        @endcan
                        @can('supply_add')
                        <a href="{{url('vendor/create')}}" class="menu-item {{ ($segment1 == 'vendor' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Supply Partner')}}</a>
                        @endcan
                    </div>
                </div>
                @endcan
                
                 @can('client_lists')
                <div class="nav-item {{ ($segment1 == 'client') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-users"></i><span>{{ __('Client')}}</span></a>
                    <div class="submenu-content">
                        @can('client_lists')
                        <a href="{{url('client')}}" class="menu-item {{ ($segment1 == 'client' && $segment2 == '') ? 'active' : '' }}">{{ __('List Client')}}</a>
                        @endcan
                        @can('client_add')
                        <a href="{{url('client/create')}}" class="menu-item {{ ($segment1 == 'client' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Client')}}</a>
                        @endcan
                    </div>
                </div>
                @endcan
                
                @can('corporate_lists')    
                <div class="nav-item {{ ($segment1 == 'corporate') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-users"></i><span>{{ __('Corporate')}}</span></a>
                    <div class="submenu-content">
                        @can('corporate_lists')
                        <a href="{{url('corporate')}}" class="menu-item {{ ($segment1 == 'corporate' && $segment2 == '') ? 'active' : '' }}">{{ __('List Corporate')}}</a>
                        @endcan
                        @can('corporate_add')
                        <a href="{{url('corporate/create')}}" class="menu-item {{ ($segment1 == 'corporate' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Corporate')}}</a>
                        @endcan
                    </div>
                </div>
                @endcan
                
                @can('miscellaneous_show')
                 <div class="nav-item {{ ($segment1 == 'state' || $segment1 == 'city' || $segment1 == 'measurement' || $segment1 == 'delivery') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-users"></i><span>{{ __('Miscellaneous')}}</span></a>
                    <div class="submenu-content">
                             <a href="{{url('state')}}" class="menu-item {{ ($segment1 == 'state' && $segment2 == '') ? 'active' : '' }}">{{ __('List State')}}</a>
                             
                        <a href="{{url('city')}}" class="menu-item {{ ($segment1 == 'city' && $segment2 == '') ? 'active' : '' }}">{{ __('List City')}}</a>
                        
                        <a href="{{url('measurement')}}" class="menu-item {{ ($segment1 == 'measurement' && $segment2 == '') ? 'active' : '' }}">{{ __('List UOM')}}</a>
                        
                        <a href="{{url('delivery')}}" class="menu-item {{ ($segment1 == 'delivery' && $segment2 == '') ? 'active' : '' }}">{{ __('List Delivery')}}</a>
                        
                    </div>
                </div>
                @endcan


                
                @can('administrator_show')
                <div class="nav-item {{ ($segment1 == 'users' || $segment1 == 'roles'||$segment1 == 'permission' ||$segment1 == 'user') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Adminstrator')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('administrator_users')
                        <a href="{{url('users')}}" class="menu-item {{ ($segment1 == 'users') ? 'active' : '' }}">{{ __('Users')}}</a>
                        
                         @endcan
                         <!-- only those have manage_role permission will get access -->
                        @can('administrator_role')
                        <a href="{{url('roles')}}" class="menu-item {{ ($segment1 == 'roles') ? 'active' : '' }}">{{ __('Roles')}}</a>
                        @endcan
                        <!-- only those have manage_permission permission will get access -->
                        @can('administrator_permission')
                        <a href="{{url('permission')}}" class="menu-item {{ ($segment1 == 'permission') ? 'active' : '' }}">{{ __('Permission')}}</a>
                        @endcan
                    </div>
                </div>
                @endcan
            



                <!-- end inventory pages -->

                
        </div>
    </div>
</div>