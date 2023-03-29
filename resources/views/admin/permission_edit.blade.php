 <!-- Modal -->

<div class="modal-dialog modal-dialog-top modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Permission Update</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color: red!important;">
                <span aria-hidden="true" style="color:white;">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="row" id="ajax_form" action="{{route('admin.permission.update')}}" method="POST">
                @csrf
                <input type="hidden" name="dataId" value="{{$dataInfo->id}}">
                <div class="col-6 form-group">
                    <strong>Permission Name</strong>
                    <input type="text" name="name" placeholder="Permission Name" class="form-control" required value="{{$dataInfo->name}}">
                     <span style="color:red" ></span>
                </div>
                <div class="col-6 form-group">
                    <strong>Guard Name</strong>
                    <input type="text" name="guard_name" placeholder="Guard Name" class="form-control custom-input-readonly" value="{{$dataInfo->guard_name}}" required readonly >
                     <span style="color:red" ></span>
                </div>
                
            
                <div class="col-12 d-flex flex-row-reverse">
                    <button class="btn btn-primary btn-icon" type="submit">
                       <i data-feather='save'></i> Update
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</div>
