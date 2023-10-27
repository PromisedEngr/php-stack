
   
  


    <div class="col-lg-3 col-sm-4">
    <div class="user-details-tab-left">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link customer_menu {{ (Route::getCurrentRoute()->uri=='vendordashboard') ? 'active' : '' }}"  id="v-pills-dashboard-tab"  href="{{ url('/vendordashboard') }}">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon1.png')}}" class="img-fluid icon-black" alt="">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon1-g.png')}}" class="img-fluid icon-green" alt="">Dashboard
            </a>

            <a class="nav-link customer_menu {{ (Route::getCurrentRoute()->uri=='vendor/view_profile') ? 'active' : '' }}" id="v-pills-customer-profile-tab"  href="{{ url('/vendor/view_profile') }}" >
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon2.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon2-g.png')}}" class="img-fluid icon-green" alt="">Vendor Profile
            </a>

            <a class="nav-link customer_menu {{ (Route::getCurrentRoute()->uri=='vendor/vouchers') ? 'active' : '' }}" id="v-pills-transaction-tab"  href="{{ url('/vendor/vouchers') }}" >
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon3.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon3-g.png')}}" class="img-fluid icon-green" alt="">Voucher
            </a>

            <a class="nav-link customer_menu {{ (Route::getCurrentRoute()->uri=='vendor/get-tasks') ? 'active' : '' }}" id="v-pills-graphic-expenditure-tab"  href="{{ url('/vendor/get-tasks') }}">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon4.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon4-g.png')}}" class="img-fluid icon-green" alt="">Your Tasker
            </a>

            <a class="nav-link customer_menu {{ (Route::getCurrentRoute()->uri=='vendor/wallets') ? 'active' : '' }}" id="v-pills-redemption-tab"  href="javascript:void(0)">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon5.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon5-g.png')}}" class="img-fluid icon-green" alt="">My wallet
            </a>

            <a class="nav-link customer_menu {{ (Route::getCurrentRoute()->uri=='vendor/vip-packages') ? 'active' : '' }}" id="v-pills-reviews-tab"  href="javascript:void(0)">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon6.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon6-g.png')}}" class="img-fluid icon-green" alt="">VIP Package
            </a>

            <a class="nav-link customer_menu {{ (Route::getCurrentRoute()->uri=='vendor/marketing-tools') ? 'active' : '' }}" id="v-pills-wallet-tab"  href="javascript:void(0)">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon7.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon7-g.png')}}" class="img-fluid icon-green" alt="">Marketing Tools
            </a>

            <a class="nav-link customer_menu {{ (Route::getCurrentRoute()->uri=='vendor/chatwithvendor') ? 'active' : '' }}" id="v-pills-customer-tab"  href="{{ url('/vendor/chatwithvendor') }}" >
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon8.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon8-g.png')}}" class="img-fluid icon-green" alt="">Chat with Customer
            </a>

            <a class="nav-link customer_menu {{ (Route::getCurrentRoute()->uri=='vendor/reports') ? 'active' : '' }}" id="v-pills-chat-with-admin-tab"  href="javascript:void(0)">
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon9.png')}}" class="img-fluid icon-black" alt=""> 
                <img src="{{ asset('public/assets/images/new_customer_image/images/icon9-g.png')}}" class="img-fluid icon-green" alt="">Report
            </a>
        </div>
    </div>
</div>
