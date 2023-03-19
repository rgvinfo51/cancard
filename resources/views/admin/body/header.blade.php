@php
$prefix= Request::route()->getPrefix();
$route= Route::current()->getName();
@endphp
            <div id="layout-wrapper">
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('public') }}/backend/assets/images/logo.svg" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('public') }}/backend/assets/images/logo-dark.png" alt="" height="17">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('public') }}/backend/assets/images/logo-light.svg" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('public') }}/backend/assets/images/logo-light.png" alt="" height="19">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                        
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-user font-size-16 align-middle me-1"></i>
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry">Admin</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                                <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Change Password</span></a>
                                <!--<a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span key="t-my-wallet">My Wallet</span></a>
                                <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>
                                <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Lock screen</span></a>-->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{route('admin.logout')}}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
                
                  <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="{{ ($route == 'admin.dashboard')? 'mm-active' : '' }}">
                                <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-dashboards">Dashboards</span>
                                </a>
                            </li>
                            <li class="{{ ($route == 'allvendors')? 'mm-active' : '' }}">
                                <a href="{{ route('allvendors') }}" class="waves-effect">
                                    <i class="bx bx-store"></i>
                                    <span key="t-ecommerce">Vendors</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-store"></i>
                                    <span key="t-ecommerce">Products</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li class="{{ ($route == 'allproduct')? 'mm-active' : '' }}"><a href="{{ route('allproduct') }}">Products</a></li>
                                    <li class="{{ ($route == 'allcategory')? 'mm-active' : '' }}"><a href="{{ route('allcategory') }}">Category</a></li>
                                    <li class="{{ ($route == 'allapplications')? 'mm-active' : '' }}"><a href="{{ route('allapplications') }}">Applications</a></li>
                                    <li class="{{ ($route == 'productpricingimport')? 'mm-active' : '' }}"><a href="{{ route('productpricingimport') }}">Pricing Import</a></li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-store"></i>
                                    <span key="t-ecommerce">Customer</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li class="{{ ($route == 'allcustomers')? 'mm-active' : '' }}"><a href="{{ route('allcustomers') }}">Customer</a></li>
                                    <li class="{{ ($route == 'allcustomertypes')? 'mm-active' : '' }}"><a href="{{ route('allcustomertypes') }}">Customer Types</a></li>
                                    <li class="{{ ($route == 'customerimport')? 'mm-active' : '' }}"><a href="{{ route('customerimport') }}">Customer Import</a></li>
                                    <li class="{{ ($route == 'customerpricingimport')? 'mm-active' : '' }}"><a href="{{ route('customerpricingimport') }}">Customer Price Import</a></li>
                                </ul>
                            </li>
                             <li class="{{ ($route == 'adminorders')? 'mm-active' : '' }}">
                                <a href="{{ route('adminorders') }}" class="waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-ecommerce">Orders</span>
                                </a>
                            </li>
                             <li class="{{ ($route == 'adminmyquotes')? 'mm-active' : '' }}">
                                <a href="{{ route('adminmyquotes') }}" class="waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-ecommerce">Quotes</span>
                                </a>
                            </li>
                             <li class="{{ ($route == 'allnews')? 'mm-active' : '' }}">
                                <a href="{{ route('allnews') }}" class="waves-effect">
                                    <i class="bx bx-news"></i>
                                    <span key="t-ecommerce">News</span>
                                </a>
                            </li>
                        </ul>
                        <?php /*
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-store"></i>
                                    <span key="t-ecommerce">Products</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('productlist') }}" key="t-default">All Products</a></li>
                                    <li><a href="{{ route('addproduct') }}" key="t-saas">Add Product</a></li>
                                    <li><a href="{{ route('categorylist') }}">Categories</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-store"></i>
                                    <span key="t-ecommerce">Orders</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('orderslist') }}" key="t-default">All Orders</a></li>
                                   
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-store"></i>
                                    <span key="t-ecommerce">Customers</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('customerlist') }}" key="t-default">All Customers</a></li>
                                   <li><a href="{{ route('customertypelist') }}" key="t-default">Customer Types</a></li>
                                </ul>
                            </li>

                            

                        </ul>
                         * 
                         */?>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
            
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">