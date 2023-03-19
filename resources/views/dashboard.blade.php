@extends('frontend.mainmaster')
@section('content')
    <main class="main-container dashboardmy">
        <div class="myaccount-wrap">
            <div class="container">
                <div class="myaccount-content-block">
                    @include('frontend.myaccount.leftsidebar')

                    <div class="right-con dashboard-con">
                        <span class="dashboard-content">
                            <h2>My Dashboard</h2>
                        </span>
                        <p class="block w-100">From your account dashboard you can view your <a class="blue-font blue-font-anchor">recent orders</a>, manage your <a class="blue-font blue-font-anchor">shipping and billing addresses</a>, and <a class="blue-font blue-font-anchor">edit your password and account details.</a></p>
                    </div>
                </div>
            </div>
        <div>
    </main>
@endsection