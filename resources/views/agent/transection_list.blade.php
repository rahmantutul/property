@extends('layouts.backends.master')
@section('title','Transection List')
@section('content')

<div class="row mb-1">
    <div class="col-8">
    <h2 class="content-header-title float-left mb-0">Market Activity</h2>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
            <a class="btn-icon btn btn-primary btn-round btn-sm" href="{{ route('admin.marketActivity.index') }}">Add New</a>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                
                <div class="card-body">
                   <form action=""  method="get" class="row">
                    @csrf
                    <div class="col-md-2 col-sm-6 form-group">
                        <strong>Transection ID:</strong>
                        <input class="form-control" name="name" placeholder="Amenity" value="{{request()->name}}">
                    </div>
                    <div class="col-md-1  form-group">
                        <strong></strong><br>
                         <button type="submit" class="btn-icon btn btn-primary btn-round btn-sm " title="Search">
                            <i data-feather='search'></i> 
                        </button>
                    </div>
                    <div class="col-md-1 form-group">
                        <strong></strong><br>
                         <button type="submit" class="btn-icon btn btn-warning btn-round btn-sm " title="Reset">
                            <i data-feather='refresh-ccw'></i>
                        </button>
                    </div>
                   </form>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl/No</th>
                                <th>Transecttion ID</th>
                                <th>Date</th>
                                <th>Agent Name</th>
                                <th>Appove</th>
                                <th>Mail</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-center">1</th>
                                <td>00-1</td>
                                <td>03/03/2022</td>
                                <td>Rahman Tutul</td>
                                <td>
                                    <span class="badge badge-pill badge-success">Approve</span>
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-success">Send</span>
                                    <span class="badge badge-pill badge-warning">View</span>
                                </td>
                                <td>
                                    <a href="" class="btn btn-sm btn-icon btn_status_change" title="Change Status">
                                        
                                    </a>
                                    <a href="" class="btn btn-warning btn-sm btn-icon btn_modal" title="Edit">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm btn-icon delete" title="Delete">
                                        <i data-feather='trash-2'></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                       
                    </table>
                
                </div>
                
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
</div>
@endsection

