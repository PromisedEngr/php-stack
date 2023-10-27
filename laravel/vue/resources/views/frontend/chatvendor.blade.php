@extends('vendar.layouts.design')
@section('content')
<style type="text/css">
    .chat-details-box .chat-details-box-lt-side .thumb_img {
        width: 60px;
        height: 60px;
        overflow: hidden;
        border-radius: 50%;
    }
    .chat-details-box .chat-details-box-lt-side .thumb_img img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
    button.chat-send-btn.btn_disable {
        cursor: not-allowed;
    }
    .chat-userimg.online::after {
     background: #198916; 
    }
    .error{
        color:red;
    }
</style>
<section class="user-details-tab">
    <div class="row">
        @include('vendar.sidebar')
        <div class="col-lg-9 col-sm-8">
            <div class="user-details-tab-right">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-customer-profile" role="tabpanel" aria-labelledby="v-pills-customer-profile-tab">
                        <div class="dashboard-right1">
                            <h3>Vendor Chat With Customer</h3>
                        </div>
                        <div class="dashboard-right2">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="dashboard-right" >
                                        <div class="tab-content" >
                                            <div class="tab-pane active" >
                                                <div class="row" >
                                                    <div class="col-lg-4 col-sm-12 p-0" >
                                                        <div class="chatbox-left" id="chatdashbordleftVendor">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-sm-12">
                                                        <div class="chatbox-right">
                                                            <div class="no_chat_selected" id="customer_not_selected"> 
                                                                No Chat Selected.
                                                            </div>
                                                            <div class="selected_chat" id="selected_vendor" style="display:none;">
                                                                <div class="tab-content">
                                                                    <div class="tab-pane active">
                                                                        <div class="chat-details-box">
                                                                            <div class="chat-details-box-upper">
                                                                                <div class="chat-details-box-lt-side">
                                                                                    <div class="thumb_img" >
                                                                                        <img class="" id="customer_profileimage" alt="User">
                                                                                    </div>
                                                                                    <div id="customer_name">
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                <div class="chat-details-box-rt-side">
                                                                                    <!-- <a herf="javascript:void(0)" id="award_work">Award</a>
                                                                                    <a herf="javascript:void(0)" id="create_milestone_customer">Create Milestone</a> -->
                                                                                    <a herf="javascript:void(0)" id="request_money">Request Money</a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="chat-details-box-bottom">
                                                                                <div class="chat-box-info" id="selectedChatCustomer">
                                                                                    
                                                                                    
                                                                                </div>
                                                                                <div class="chat-send-area">
                                                                                    <div class="send-box">
                                                                                        <input type="text" id="text_message_vendor" class="form-control" placeholder="Write your message...">
                                                                                    </div>

                                                                                    <button class="chat-send-btn" id="sendchat_toCustomer">
                                                                                        <i class="fas fa-paper-plane fa-fw"></i>
                                                                                    </button>
                                                                                    <input type="hidden" id="customer_to_id" name="customer_to_id" value="">
                                                                                    <input type="hidden" id="vendor_to_id" name="vendor_to_id" value="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(!empty(Auth::guard('vendor')->user()->id))
    <script type="text/javascript">
        var ROLE_ID = {!! json_encode(Auth::guard('vendor')->user()->role) !!};
        var VENDOR_ID = {!! json_encode(Auth::guard('vendor')->user()->id) !!};
    </script>
@endif

<script type="text/javascript" src="{{ asset('public/assets/js/view/chat.js') }} "></script>


@endsection