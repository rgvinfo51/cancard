@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Profile Information</h4>

                                    
                                </div>
                            </div>
                        </div>
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <x-jet-validation-errors class="mb-4" />
                                      @if (session('status'))
                                            <div class="mb-4 font-medium text-sm text-green-600">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Admin Info</h4>

                                        <form method="post" action="{{route('admin.profile.update')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="formrow-firstname-input" class="form-label">Name</label>
                                                        <input type="text" class="form-control" name="name" id="formrow-firstname-input" value="{{ Auth::user()->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="formrow-email-input" class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="email" id="formrow-email-input" value="{{ Auth::user()->email }}">
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div>
                                                <button type="submit" class="btn btn-primary w-md">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Change Password</h4>

                                        <form method="post" action="{{route('admin.password.update')}}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="formrow-password-input" class="form-label">Current Password</label>
                                                        <input type="password" name="currentpassword" class="form-control" id="formrow-password-input" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="formrow-password-input" class="form-label">New Password</label>
                                                        <input type="password" name="password" class="form-control" id="formrow-password-input" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="formrow-password-input" class="form-label">Confirm Password</label>
                                                        <input type="password" name="password_confirmation" class="form-control" id="formrow-password-input" required="">
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>

                                            <div>
                                                <button type="submit" class="btn btn-primary w-md">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <!-- end page title -->
</div>
@endsection