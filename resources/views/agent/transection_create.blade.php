@extends('layouts.backends.master')
@section('title','Admin Create')
@push('css')
<style>
    .form-devider{
        padding: 12px ;
        background: #E8DAEF;
        border-radius: 4px;
    }
</style>
@endpush
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Transection Entry</h2>
    </div>
    <div class="col-4 d-flex flex-row-reverse">
    <a class="btn btn-primary btn-round btn-sm" href="{{route('agent.transection.index')}}">Transection List</a>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">           
                <div class="card-body">
                    <form class="row" id="ajax_form" action="{{route('agent.transection.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="agentId" value="{{ Auth::guard('agent')->user()->id }}">
                        <div class="col-4 form-group">
                            <strong>Transection Types:</strong>
	                        <select class="form-control select2" name="transection_type" >
	                            <option value="">Choose Type</option>
	                            <option value="1">Sale Transection</option>
	                            <option value="2">Listing Transection</option>
	                            <option value="3">Others</option>
	                        </select>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Listing Price:</strong>
                            <input type="number" name="listing_price" placeholder="Listing Price" class="form-control" required >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Sold Price:</strong>
                            <input type="number" name="sold_price" placeholder="Sold Price" class="form-control" required >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Listing Date:</strong>
                            <input type="date" name="listing_date" placeholder="Listing Date" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Sold Date:</strong>
                            <input type="date" name="sold_date" placeholder="Sold Date" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12">
                            <h4 class="form-devider">Prpperty Details</h4>
                        </div>

                        <div class="col-4 form-group">
                            <strong>Property Address:</strong>
                            <input type="text" name="property_address" placeholder="Property Address" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>City:</strong>
                            <input type="text" name="city" placeholder="City" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>State:</strong>
	                        <select class="form-control select2" name="state" >
	                            <option value="">Choose Type</option>
	                            <option value="1">Arizona</option>
	                            <option value="2">Oregon</option>
	                            <option value="3">Washington</option>
	                            <option value="4">Other</option>
	                        </select>
                             <span style="color:red" ></span>
                        </div>

                        <div class="col-4 form-group">
                            <strong>Zip:</strong>
                            <input type="text" name="zip" placeholder="Zip" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>

                        <div class="col-12">
                            <h4 class="form-devider">Buyer Details</h4>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Buyer 1 Name:</strong>
                            <input type="text" name="buyer_one_name" placeholder="Buyer 1 Name" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Buyer 2 Name:</strong>
                            <input type="text" name="buyer_two_name" placeholder="Buyer 2 Name" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Buyer Address:</strong>
                            <input type="text" name="buyer_address" placeholder="Buyer Address" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Buyer Phone:</strong>
                            <input type="text" name="buyer_phone" placeholder="Buyer Phone" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Buyer's Agent:</strong>
                            <input type="text" name="buyer_agent" placeholder="Buyer Agent:" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Buyer's Agent email:</strong>
                            <input type="email" name="buyer_agent_email" placeholder="Buyer Agent Email:" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Buyer's Agent phone:</strong>
                            <input type="text" name="buyer_agent_phone" placeholder="Buyer Agent Phone:" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>


                        <div class="col-12">
                            <h4 class="form-devider">Seller Details</h4>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Seller 1 Name:</strong>
                            <input type="text" name="seller_one_name" placeholder="Seller 1 Name" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Seller 2 Name:</strong>
                            <input type="text" name="seller_two_name" placeholder="Seller 2 Name" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Seller Address:</strong>
                            <input type="text" name="seller_address" placeholder="Seller Address" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Seller Phone:</strong>
                            <input type="text" name="seller_phone" placeholder="Buyer Phone" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Seller's Agent:</strong>
                            <input type="text" name="seller_agent" placeholder="Buyer Agent:" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Seller's Agent email:</strong>
                            <input type="email" name="seller_agent_email" placeholder="Seller Agent Email:" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Seller's Agent phone:</strong>
                            <input type="text" name="seller_agent_phone" placeholder="Seller Agent Phone:" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12">
                            <h4 class="form-devider">Title Information</h4>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Closing Title:</strong>
                            <input type="text" name="closing_title" placeholder="Closing Title" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Escrow Tran#:</strong>
                            <input type="text" name="escrow_transection" placeholder="Escrow Transection" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Title Address:</strong>
                            <input type="text" name="title_address" placeholder="Title Address" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Title Phone:</strong>
                            <input type="text" name="title_phone" placeholder="Title Phone" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Title's Agent:</strong>
                            <input type="text" name="title_agent" placeholder="Title Agent:" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Title email:</strong>
                            <input type="email" name="title_email" placeholder="Title Email:" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12">
                            <h4 class="form-devider">Misc Information</h4>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Commission Amount:</strong>
                            <input type="number" name="commission_amount" placeholder="Commission Amount" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Commission Type:</strong>
	                        <select class="form-control select2" name="commission_type" >
	                            <option value="">Choose Type</option>
	                            <option value="Percentage">Percentage</option>
	                            <option value="Fixed">Fixed</option>
	                            <option value="Referral Fee">Referral Fee</option>
	                            <option value="Other">Other</option>
	                        </select>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Earnest Money Amount:</strong>
                            <input type="number" name="earnest_money" placeholder="Earnest Money Amount" class="form-control"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Earnest Money Held By:</strong>
	                        <select class="form-control select2" name="earnest_money_holder" >
	                            <option value="">Choose Type</option>
	                            <option value="Title">Title</option>
	                            <option value="Listing Co.">Listing Co.</option>
	                            <option value="Selling Co.">Selling Co.</option>
	                        </select>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Home Warrnety Provided By:</strong>
	                        <select class="form-control select2" name="home_warrenty" >
	                            <option value="">Choose One</option>
	                            <option value="Buyer Agent">Buyer Agent</option>
	                            <option value="Seller Agent">Seller Agent</option>
	                            <option value="Buyer">Buyer</option>
	                            <option value="Seller">Seller</option>
	                            <option value="Other">Other</option>
	                            <option value="None">None</option>
	                        </select>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Notes For Broker Instruction:</strong>
                            <input type="text" name="broker_note" placeholder="Broker Note" class="form-control" required >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Agent Notes For this Instruction and Admin:</strong>
                            <input type="text" name="agent_note" placeholder="Agent Note" class="form-control" required >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>Office Notes:</strong>
                            <input type="text" name="office_note" placeholder="Office Note" class="form-control" required >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12">
                            <h4 class="form-devider">Send Mail</h4>
                        </div>
                        <div class="col-12 form-group">
                            <strong>Send Mail:</strong>
                            <input type="email" name="send_mail" class="form-control">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12">
                            <h4 class="form-devider">Upload</h4>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Image:</strong>
                            <input type="file" name="image" class="form-control">
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-6 form-group">
                            <strong>Video Url:</strong>
                            <input type="url" name="video_url" placeholder="Past URL" class="form-control"  >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12 d-flex flex-row-reverse">
                            <button class="btn btn-primary btn-icon" type="submit">
                               <i data-feather='save'></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
@endpush
       