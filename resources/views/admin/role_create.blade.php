 <!-- Modal -->

<div class="modal-dialog modal-dialog-top modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Designation Update</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color: red!important;">
                <span aria-hidden="true" style="color:white;">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="row" id="ajax_form" action="{{route('admin.role.store')}}" method="post">
                @csrf
              
                <div class="col-4 form-group">
                    <strong>English Name</strong>
                    <input type="text" name="name" placeholder="English Name" class="form-control"  required>
                     <span style="color:red" ></span>
                </div>
                <div class="col-4 form-group">
                    <strong>Level:</strong>
                    <input type="number" name="orderBy" placeholder="Level" class="form-control" >
                     <span style="color:red" ></span>
                </div>
                <div class="col-12 form-group">
                    <strong>Permission:</strong>
                    <div class="row">
                     @foreach($permission as $value)
                        <div class="col-3">
                            <div class="custom-control custom-control-success custom-checkbox">
                                <input type="checkbox" name="permission[]" value="{{$value->id}}" id="permission_{{$value->id}}" class="custom-control-input">
                                
                                <label class="custom-control-label" for="permission_{{$value->id}}">{{$value->name}}</label>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="col-12 d-flex flex-row-reverse">
                    <button class="btn btn-primary btn-icon" type="submit">
                       <i data-feather='save'></i> Save
                    </button>
                    <button class="btn btn-warning btn-icon mr-1" type="reset">
                       <i data-feather='reset'></i> Reset
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</div>
