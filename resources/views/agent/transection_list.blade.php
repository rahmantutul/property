@extends('layouts.backends.master')
@section('title', 'Transection List')
@section('content')

    <div class="row mb-1">
        <div class="col-8">
            <h2 class="content-header-title float-left mb-0">Market Activity</h2>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <a class="btn-icon btn btn-primary btn-round btn-sm" href="" data-toggle="modal" data-target="#exampleModal">Add
                    New</a>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Basic Tables start -->
        <div class="row" id="basic-table">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form action="" method="get" class="row">
                            @csrf
                            <div class="col-md-2 col-sm-6 form-group">
                                <strong>Transaction ID:</strong>
                                <input class="form-control" name="name" placeholder="Transaction ID" value="">
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
                                    <th>Transaction ID</th>
                                    <th>Date</th>
                                    <th>Agent Name</th>
                                    <th>Approve</th>
                                    <th>View</th>
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
                                        <span class="badge badge-pill badge-warning">View</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Basic Tables end -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
