@extends('layouts.backends.master')
@section('title', 'Property List')

@section('content')

    <div class="row mb-1">
        <div class="col-8">
            <h2 class="content-header-title float-left mb-0">Property List From Reso</h2>
        </div>
        <div class="col-4 d-flex flex-row-reverse">
            <a class="btn btn-primary btn-round btn-sm " href="{{ route('admin.metadata.store') }}">Add Meta Data</a>
        </div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif


    </div>
    <div class="content-body">
        <!-- Basic Tables start -->
        <div class="row" id="basic-table">
            <div class="col-12">
                <div class="card">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl/No</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">URL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataList as $key => $dataInfo)
                                    <tr>
                                        <th class="text-center">{{ ++$key }}</th>
                                        <td class="text-center">{{ $dataInfo->name }}</td>
                                        <td class="text-center">{{ $dataInfo->url }}</td>
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
