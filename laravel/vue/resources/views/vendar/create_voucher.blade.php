
@extends('vendar.layouts.design')

@section('content')

  <div class="vendor-dashboard inner-sec-bg">
    <div class="container">
      <h3>Add Voucher</h3>
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
                  <form name="createVoucher" action="{{route('vendar.store_voucher')}}" method="POST">
                      @csrf
                    
                      <div class="form-group row col-md-12">
                        <label for="exampleInputEmail1">Voucher Name: <span class="is-required">*</span></label>
                        <input type="text" class="form-control" name="voucher_name" placeholder="Enter Voucher Name" value="{{ old('voucher_name') }}">
                        @if ($errors->has('voucher_name'))
                          <span class="text-danger">{{ $errors->first('voucher_name') }}</span>
                        @endif
                      </div>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label>Start Date: <span class="is-required">*</span></label>
                          <div class="input-group mb-2 mr-sm-2">
                            <input type="text" name="add_date" id="add_date" class="form-control datepicker datefield" placeholder="Enter Start Date" value="{{ old('add_date') }}" autocomplete="off">
                          </div>
                          @if ($errors->has('add_date'))
                            <span class="text-danger">{{ $errors->first('add_date') }}</span>
                          @endif
                        </div>

                        <div class="col-md-6">
                          <label>End Date: <span class="is-required">*</span></label>
                          <div class="input-group mb-2 mr-sm-2">
                            <input type="text" name="expiry_date" id="expiry_date" class="form-control datepicker datefield" placeholder="Enter End Date" value="{{ old('expiry_date') }}" autocomplete="off">
                          </div>
                          @if ($errors->has('expiry_date'))
                            <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                          @endif
                        </div>
                      </div>
                      
                      
                      <div class="form-group row col-md-12">
                        <label>Description: <span class="is-required">*</span></label>
                        <textarea name="description" class="form-control" cols="10" rows="5"> {{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                          <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                      </div>

                      <div class="form-group row col-md-12">
                        <label>Voucher Discount(%): <small>(numeric value only)</small><span class="is-required">*</span></label>
                        <input type="number" name="voucher_point" class="form-control" placeholder="Enter Voucher Discount. Like 10" value="{{ old('voucher_point') }}">
                        @if ($errors->has('voucher_point'))
                          <span class="text-danger">{{ $errors->first('voucher_point') }}</span>
                        @endif
                      </div>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label>Country: <span class="is-required">*</span></label>
                          {{ Form::select('fk_country_id',$countryDp,'132',array('class'=>'form-control select2','id'=>'country','placeholder'=>'Please select')) }}
                          @if ($errors->has('fk_country_id'))
                            <span class="text-danger">{{ $errors->first('fk_country_id') }}</span>
                          @endif
                        </div>

                        <div class="col-md-6">
                        <label>State: <span class="is-required">*</span></label>
                          {{ Form::select('fk_state_id',$stateDp,'',array('class'=>'form-control select2','id'=>'state','placeholder'=>'Please select')) }}
                          @if ($errors->has('fk_state_id'))
                            <span class="text-danger">{{ $errors->first('fk_state_id') }}</span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-6">
                          <label>Category: <span class="is-required">*</span></label>
                          {{ Form::select('fk_category_id',$categoryDp,'',array('class'=>'form-control select2','id'=>'fk_category_id','placeholder'=>'Please select')) }}
                          @if ($errors->has('fk_category_id'))
                            <span class="text-danger">{{ $errors->first('fk_category_id') }}</span>
                          @endif
                        </div>

                        <div class="col-md-6">
                        <label>Sub Category: </label>
                          {{ Form::select('fk_sub_category_id',array(''=>'Select Sub Category'),'',array('class'=>'form-control select2','id'=>'fk_sub_category_id','placeholder'=>'Please select')) }}
                          @if ($errors->has('fk_sub_category_id'))
                            <span class="text-danger">{{ $errors->first('fk_sub_category_id') }}</span>
                          @endif
                        </div>
                        
                      </div>
                      <div class="form-group row">
                        <div class="col-md-12">
                          <a href="#" class="btn btn-sm btn-success add_category">Add Category</a>
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

  <div id="category_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form name="add_category_form" action="{{ route('vendor.voucher_category_submit') }}" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="from-group col-md-12">
              <label>Parent Category: </label><br>
              {{ Form::select('parent_id',$categoryDp,'',array('class'=>'form-control select2','id'=>'parent_id','placeholder'=>'Please select')) }}
              @if ($errors->has('parent_id'))
                <span class="text-danger">{{ $errors->first('parent_id') }}</span>
              @endif
            </div>
            <div class="from-group col-md-12">
              <label>Category Name: </label>
              <input type="text" name="name" class="form-control" placeholder="Enter Category Name" value="{{ old('name') }}">
              @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
              @endif
            </div>
         
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="{{ asset('public/assets/js/view/vendors/voucher.js') }} "></script>
@endsection
