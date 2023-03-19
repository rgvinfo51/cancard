@extends('frontend.mainmaster')
@section('content')

<main class="main-container profilearea">
<div class="myaccount-wrap">
    <div class="container">
        <div class="myaccount-content-block">    
            @include('frontend.myaccount.leftsidebar')
            
            <div class="right-con address-profile-con">
                <h2>Security</h2>
                <ul>
                    <li> <h4><a data-toggle="modal" data-target="#myModal" class="btn btn-primary">Change Password <i class="fas fa-key"></i></a></h4> </li>
                </ul>
            </div>
        </div>
    </div>

    @if($errors->has('new_password') || $errors->has('confirm_password'))
    <script>
        $(document).ready(function(){
            $("#myModal").modal("show");
        });
    </script>
    @endif

    <!-- The Modal -->
    <div class="modal fade mt-5 pt-5" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Change Password</h4>
                    <button type="button" class="close" data-dismiss="modal" style="font-size: 20px;padding: 15px 20px;">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="auth-wrap">
                        <form method="POST" action="{{ route('update.user.password') }}" class="block w-100">
                            <input type="hidden" name="user_id" value="{{$customerdata['id']}}">
                            <div class="card-body bg-white">
                                    @csrf
                                    <div class="form-row row">
                                        <div class="col-12 form-group required mb-3">
                                            <label class="control-label" for="current_password">Current Password</label> <input autocomplete="off" class="form-control" value="{{old('current_password')}}" placeholder="Current Password" name="current_password" id="current_password" size="20" type="text" required>
                                            @if($errors->has('current_password'))
                                            <span class="text-danger">{{$errors->first('current_password')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-row row">
                                        <div class="col-12 form-group mb-3">
                                            <label class="control-label font-12" for="new_password">New Password</label> <input autocomplete="off" class="form-control" value="{{old('new_password')}}" placeholder="New Password" size="4" type="text" name="new_password" id="new_password" required>
                                            @if($errors->has('new_password'))
                                            <span class="text-danger">{{$errors->first('new_password')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-row row">
                                        <div class="col-12 form-group mb-3">
                                            <label class="control-label font-12" for="confirm_password">Confirm New Password</label> <input autocomplete="off" class="form-control" value="{{old('confirm_password')}}" placeholder="Confirm New Password" size="4" type="text" name="confirm_password" id="confirm_password" required>
                                            @if($errors->has('confirm_password'))
                                            <span class="text-danger">{{$errors->first('confirm_password')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                            </div>
                    </div>
                </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-primary">Update Password</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form>

            </div>
        </div>
    </div>
</div>
</main>
@endsection