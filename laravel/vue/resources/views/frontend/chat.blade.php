@extends('customer.layouts.design')
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
        <!-- @if(!empty(Auth::guard('vendor')->user()->id))
            <h3>Vendor Chat</h3>
        @else
            <h3>Customer Chat</h3>
        @endif -->

        @if(!empty(Auth::guard('vendor')->user()->id))
            @include('vendar.sidebar')
        @else
            @include('customer.sidebar')
        @endif
        <div class="col-lg-9 col-sm-8">
            <div class="user-details-tab-right">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-customer-profile" role="tabpanel" aria-labelledby="v-pills-customer-profile-tab">
                        <div class="dashboard-right1">
                            <h3>CUSTOMER CHAT</h3>
                        </div>
                        <div class="dashboard-right2">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                        <div class="dashboard-right" >
                                            <div class="tab-content" >
                                                <div class="tab-pane active" >
                                                    <div class="row" >
                                                        <div class="col-lg-4 col-sm-12 p-0" >
                                                            <div class="chatbox-left" id="chat_dashbord_left">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 col-sm-12">
                                                            <div class="chatbox-right">
                                                                <div class="no_chat_selected" id="vendor_not_selected"> 
                                                                    No Chat Selected.
                                                                </div>
                                                                <div class="selected_chat" id="selected_vendor" style="display:none;">
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane active">
                                                                            <div class="chat-details-box">
                                                                                <div class="chat-details-box-upper">
                                                                                    <div class="chat-details-box-lt-side">
                                                                                        <div class="thumb_img" id="vendor_image">
                                                                                        </div>
                                                                                        <div id="vendor_name">
                                                                                        </div>
                                                                                        
                                                                                    </div>
                                                                                    <div class="chat-details-box-rt-side">
                                                                                        <a herf="javascript:void(0)" id="award_work" data-toggle="modal" data-target="#selectCategoryModal">Award</a>
                                                                                        <a herf="javascript:void(0)" id="create_milestone_customer">Create Milestone</a>
                                                                                        <a herf="javascript:void(0)">Release Money</a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="chat-details-box-bottom">
                                                                                    <div class="chat-box-info" id="selectedChatVendor">
                                                                                        
                                                                                        
                                                                                    </div>
                                                                                    <div class="chat-send-area">
                                                                                        <div class="send-box">
                                                                                            <input type="text" id="text_message_customer" class="form-control" placeholder="Write your message...">
                                                                                        </div>

                                                                                        <button class="chat-send-btn" id="sendchat_toVendor">
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


    <!-- Milestone Modal -->
        <div id="milestoneModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create milestone of this Job (You can create 3 max milestones)</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" method="POST" name="milestone_create" id="milestone_create">
                            <button type="button" class="btn btn-primary" id="add_milestone">Add Milestone</button>
                            <br/>
                            <div class="form-group mt-2" id="select_service" style="display:none">
                                <select class="form-control" name="service_id" id="service_id">
                                </select>
                            </div>
                            <input type="hidden" name="hidden_milestone_id" id="hidden_milestone_id" value="" />
                            <input type="hidden" id="hidden_toggle_milestone" value="" />
                            <div class="form-group" id="more_milestone">
                            </div>
                            <div class="form-group" id="errormessage_milestone">
                            </div>
                            <input type="hidden" name="hidden_vendor_id" id="hidden_vendor_id" value="" />
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit Milestone</button>
                            </div>
                        </form>
                        <p class="text-center fl-success" id="successcustomer_milestone" style="display:none;"></p>  
                        <p class="text-center fl-success" id="errorcustomer_milestone" style="display:none;"></p> 
                    </div>
                </div>
            </div>
        </div>

    <!-- Award Modal -->

    <div class="modal fade" id="selectCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Category for this Vendor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select name="selectCategory" id="selectCategory" class="form-control">
                </select>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitawardCat">Award this Vendor</button>
            </div>
            </div>
        </div>
    </div>

    @if(!empty(Auth::guard('vendor')->user()->id))
       <script type="text/javascript">
            var ROLE_ID = {!! json_encode(Auth::guard('vendor')->user()->role) !!};
            var VENDOR_ID = {!! json_encode(Auth::guard('vendor')->user()->id) !!};
        </script>
    @else
        <script type="text/javascript">
            var ROLE_ID = {!! json_encode(Auth::guard('customer')->user()->role) !!}; 
            var CUSTOMER_ID = {!! json_encode(Auth::guard('customer')->user()->id) !!}; 
        </script>
    @endif
    
    <script type="text/javascript" src="{{ asset('public/assets/js/view/chat.js') }} "></script>
@endsection