
@extends('vendar.layouts.design')

@section('content')

  <div class="vendor-dashboard inner-sec-bg">
    <div class="container">
      <h3>Edit Voucher</h3>
      <div class="dashboard-inner">
        <div class="row">
          <div class="col-lg-3 col-sm-12">
              <div class="dashboard-left">
                 

                  <!-- Nav tabs -->
                  @include('vendar.sidebar')
              </div>
          </div>



          <div class="col-lg-9 col-sm-12">
            <div class="dashboard-right">

              <div class="card">
                  <div class="card-header">
    
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                  <form name="editVoucher" action="{{route('vendor.edit_voucher_submit')}}" method="POST">
                      @csrf
                        <input type="hidden" name="id" value="{{ $edit_data->id }}">
                      <div class="form-group row col-md-12">
                        <label for="exampleInputEmail1">Voucher Name: <span class="is-required">*</span></label>
                        <input type="text" class="form-control" name="voucher_name" placeholder="Enter Voucher Name" value="{{ $edit_data->voucher_name }}">
                        @if ($errors->has('voucher_name'))
                          <span class="text-danger">{{ $errors->first('voucher_name') }}</span>
                        @endif
                      </div>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label>Start Date: <span class="is-required">*</span></label>
                          <div class="input-group mb-2 mr-sm-2">
                            <input type="text" name="add_date" id="add_date" class="form-control datepicker datefield" placeholder="Enter Start Date" value="{{  date('d-m-Y', strtotime($edit_data->add_date))  }}">
                          </div>
                          @if ($errors->has('add_date'))
                            <span class="text-danger">{{ $errors->first('add_date') }}</span>
                          @endif
                        </div>

                        <div class="col-md-6">
                          <label>End Date: <span class="is-required">*</span></label>
                          <div class="input-group mb-2 mr-sm-2">
                            <input type="text" name="expiry_date" id="expiry_date" class="form-control datepicker datefield" placeholder="Enter End Date" value="{{ date('d-m-Y', strtotime($edit_data->expiry_date)) }}">
                          </div>
                          @if ($errors->has('expiry_date'))
                            <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                          @endif
                        </div>
                      </div>
                      
                      
                      <div class="form-group row col-md-12">
                        <label>Description: <span class="is-required">*</span></label>
                        <textarea name="description" class="form-control" cols="10" rows="5"> {{ $edit_data->description }}</textarea>
                        @if ($errors->has('description'))
                          <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                      </div>

                      <div class="form-group row col-md-12">
                        <label>Voucher Discount(%): <small>(numeric value only)</small><span class="is-required">*</span></label>
                        <input type="number" name="voucher_point" class="form-control" placeholder="Enter Voucher Point" value="{{ $edit_data->voucher_point }}">
                        @if ($errors->has('voucher_point'))
                          <span class="text-danger">{{ $errors->first('voucher_point') }}</span>
                        @endif
                      </div>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label>Country: <span class="is-required">*</span></label>
                          {{ Form::select('fk_country_id',$countryDp,$edit_data->fk_country_id,array('class'=>'form-control select2','id'=>'country')) }}
                          @if ($errors->has('fk_country_id'))
                            <span class="text-danger">{{ $errors->first('fk_country_id') }}</span>
                          @endif
                        </div>

                        <div class="col-md-6">
                        <label>State: <span class="is-required">*</span></label>
                          {{ Form::select('fk_state_id',$stateDp,$edit_data->fk_state_id,array('class'=>'form-control select2','id'=>'state')) }}
                          @if ($errors->has('fk_state_id'))
                            <span class="text-danger">{{ $errors->first('fk_state_id') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label>Category: <span class="is-required">*</span></label>
                          {{ Form::select('fk_category_id',$categoryDp,$edit_data->fk_category_id,array('class'=>'form-control select2','id'=>'fk_category_id','placeholder'=>'Please select')) }}
                          @if ($errors->has('fk_category_id'))
                            <span class="text-danger">{{ $errors->first('fk_category_id') }}</span>
                          @endif
                        </div>

                        <div class="col-md-6">
                        <label>Sub Category: </label>
                          {{ Form::select('fk_sub_category_id',$subcategoryDp,$edit_data->fk_sub_category_id,array('class'=>'form-control select2','id'=>'fk_sub_category_id','placeholder'=>'Please select')) }}
                          @if ($errors->has('fk_sub_category_id'))
                            <span class="text-danger">{{ $errors->first('fk_sub_category_id') }}</span>
                          @endif
                        </div>
                        
                      </div>

                    <div class="card-footer">
                      <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                      <a href="{{ route('vendor.vouchers') }}" class="btn btn-sm btn-danger">Cancel</a>
                    </div>
                  </form>
                  <p id="successtext"></p>
                  </div>
                  <!-- /.card-body -->
              </div>  

            </div>
          </div>


        </div>
      </div> 
    </div>   

  </div>

  

  <script type="text/javascript" src="{{ asset('public/assets/js/view/vendors/voucher.js') }} "></script>
@endsection
