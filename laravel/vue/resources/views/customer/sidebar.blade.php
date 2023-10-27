
<div class="col-lg-3 col-sm-4">
    <div class="user-details-tab-left">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link customer_menu {{ (Route::getCurrentRoute()->uri=='customerdashboard') ? 'active' : '' }}"  id="v-pills-dashboard-tab"  href="{{ url('/customerdashboard') }}">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon1.png')}}" class="img-fluid icon-black" alt="">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon1-g.png')}}" class="img-fluid icon-green" alt="">Dashboard
            </a>

            <a class="nav-link customer_menu {{ (Route::getCurrentRoute()->uri=='customer/customer_profile') ? 'active' : '' }}" id="v-pills-customer-profile-tab"  href="{{ url('/customer/customer_profile') }}" >
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon2.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon2-g.png')}}" class="img-fluid icon-green" alt="">Customer Profile
            </a>

            <a class="nav-link customer_menu" id="v-pills-transaction-tab"  href="javascript:void(0)" >
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon3.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon3-g.png')}}" class="img-fluid icon-green" alt="">List of transaction
            </a>

            <a class="nav-link customer_menu" id="v-pills-graphic-expenditure-tab"  href="javascript:void(0)">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon4.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon4-g.png')}}" class="img-fluid icon-green" alt="">Graphic Expenditure
            </a>

            <a class="nav-link customer_menu" id="v-pills-redemption-tab"  href="javascript:void(0)">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon5.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon5-g.png')}}" class="img-fluid icon-green" alt="">Redemption
            </a>

            <a class="nav-link customer_menu" id="v-pills-reviews-tab"  href="javascript:void(0)">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon6.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon6-g.png')}}" class="img-fluid icon-green" alt="">Reviews for service
            </a>

            <a class="nav-link customer_menu" id="v-pills-wallet-tab"  href="javascript:void(0)">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon7.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon7-g.png')}}" class="img-fluid icon-green" alt="">Wallet
            </a>

            <a class="nav-link customer_menu {{ (Route::getCurrentRoute()->uri=='customer/mypostedtask') ? 'active' : '' }}" id="v-pills-customer-tab"  href="{{ url('/customer/mypostedtask') }}" >
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon8.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon8-g.png')}}" class="img-fluid icon-green" alt="">Post Task As customer
            </a>

            <a class="nav-link customer_menu {{ (Route::getCurrentRoute()->uri=='customer/chatwithvendor') ? 'active' : '' }}" id="v-pills-chat-with-admin-tab"  href="{{ url('/customer/chatwithvendor') }}">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon9.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon9-g.png')}}" class="img-fluid icon-green" alt="">Chat with Vendor
            </a>
            <a class="nav-link customer_menu {{ (Route::getCurrentRoute()->uri=='customer/jobnotification') ? 'active' : '' }}" id="v-pills-chat-with-admin-tab"  href="{{ url('/customer/jobnotification') }}">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon9.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon9-g.png')}}" class="img-fluid icon-green" alt="">Job Notification
            </a>
        </div>
    </div>
</div>