@extends('layouts.backends.master')
@section('title', 'Property List')

@section('content')

    <div class="row mb-1">
        <div class="col-8">
            <h2 class="content-header-title float-left mb-0">Property List From Reso</h2>
        </div>
        <div class="col-4 d-flex flex-row-reverse">
            <a class="btn btn-primary btn-round btn-sm " href="{{ route('admin.property.create') }}">Add New Property</a>
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
                                <strong>Title:</strong>
                                <input class="form-control" name="titile" placeholder="titile"
                                    value="{{ request()->titile }}">
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
                                    <th class="text-center">Sl/No</th>
                                    <th class="text-center">Photo</th>
                                    <th class="text-center">Country</th>
                                    <th class="text-center">City</th>
                                    <th class="text-center">Close<br>Date</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Buyer Office</th>
                                    <th class="text-center">Direction</th>
                                    <th class="text-center">PropertyType</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataList as $key => $dataInfo)
                                    <tr>
                                        <th class="text-center">{{ ++$key }}</th>
                                        <td>

                                            <img src="{{ $dataInfo->Photo1URL ? resizePhotoUrl($dataInfo->Photo1URL) : '' }}"
                                                alt="Image" height="50" width="50"
                                                style="border-radius: 50%;border: 1px solid green;">
                                        </td>




                                        <td>{{ $dataInfo->Country }}</td>
                                        <td>{{ $dataInfo->City }}</td>
                                        <td>{{ !is_null($dataInfo->CloseDate) ? formatDate($dataInfo->CloseDate) : '' }}</td>
                                        <td>
                                            Price: <strong>{{ $dataInfo->CurrentPriceForStatus }}</strong><br>
                                            Orginal Price: <strong>{{ $dataInfo->ClosePrice }}</strong>
                                        </td>
                                        <td>
                                            {{ $dataInfo->BuyerOfficeName }}
                                        </td>
                                        <td>
                                            {{ $dataInfo->Directions }}
                                        </td>
                                        <td>
                                            {{ $dataInfo->PropertyType }}
                                        </td>
                                        <td>
                                            @if (isset(request()->is_featured))
                                                <a href="{{ route('admin.property.feature.change', ['dataId' => $dataInfo->id, 'is_featured' => $dataInfo->is_featured == 1 ? 2 : 0]) }}"
                                                    class="btn btn-success btn-sm btn-icon btn_status_change"
                                                    title="Approve">
                                                    <i data-feather='check'></i>
                                                </a>
                                                <a href="{{ route('admin.property.feature.change', ['dataId' => $dataInfo->id, 'is_featured' => $dataInfo->is_featured == 1 ? 0 : 1]) }}"
                                                    class="btn btn-danger btn-sm btn-icon btn_status_change"
                                                    title="Approve">
                                                    <i data-feather='x'></i>
                                                </a>
                                            @else
                                                <a href="{{ route('admin.property.status.change', ['dataId' => $dataInfo->id, 'status' => $dataInfo->status == 1 ? 2 : 1]) }}"
                                                    class="btn btn-sm btn-icon {{ getStatusChangeBtn($dataInfo->status) }} btn_status_change"
                                                    title="Change Status">
                                                    {!! getStatusChangeIcon($dataInfo->status) !!}
                                                </a>
                                                <a href="{{ route('admin.property.edit', ['dataId' => $dataInfo->id]) }}"
                                                    class="btn btn-warning btn-sm btn-icon " title="Edit">
                                                    <i data-feather='edit'></i>
                                                </a>
                                                <a href="{{ route('admin.property.delete', ['dataId' => $dataInfo->id]) }}"
                                                    class="btn btn-danger btn-sm btn-icon {{ getStatusChangeBtn($dataInfo->status) }} delete"
                                                    title="Delete">
                                                    <i data-feather='trash-2'></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                    <div class="row mt-1">
                        <div class="col-12 d-flex flex-row-reverse">
                            {!! $dataList->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Basic Tables end -->
    </div>
@endsection


