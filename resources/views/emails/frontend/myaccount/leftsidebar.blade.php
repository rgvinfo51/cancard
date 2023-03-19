<div class="left-con">
    <ul class="dashboard-menu">
        <li class="card text-center myaccount-menu-head">
            <i class="icon-user"></i>
            <h4 class="text-center">{{ Auth::user()->name }}</h4>
        </li>
        
        <li class="menu-option" id="dashboard">
            <i class="fas fa-user"></i>
            <span><a href="{{route('profile')}}">My Profile</a></span>
        </li>
        
        <li class="menu-option">
            <i class="fas fa-map-marker-alt"></i>
            <span><a href="{{route('addresses')}}">Addresses</a></span>
        </li>
        
        <li class="menu-option">
            <i class="fas fa-sticky-note"></i>
            <span><a href="{{route('orders')}}">Orders</a></span>
        </li>
        
        <li class="menu-option">
            <i class="fas fa-quote-right"></i>
            <span><a href="{{route('myquotes')}}">Quotes</a></span>
        </li>
        
        <li class="menu-option">
            <i class="fas fa-money"></i>
            <span><a href="{{route('paymentsetting')}}">Payment Setting</a></span>
        </li>

        <li class="menu-option">
            <i class="fas fa-shield-alt"></i>
            <span><a href="{{route('security')}}">Security</a></span>
        </li>
        
        <li class="menu-option">
            <i class="fas fa-sign-out-alt"></i>
            <span><a href="{{route('user.logout')}}">Log Out</a></span>
        </li>
    </ul>
</div>