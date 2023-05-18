 <!-- Modal -->

 <div class="modal-dialog modal-dialog-top modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Change File</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color: red!important;">
                <span aria-hidden="true" style="color:white;">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="row" id="ajax_form" action="{{route('admin.downloads.update')}}" method="post">
                @csrf
              <input type="hidden" name="dataId" value="{{ $dataInfo->id }}">
                <div class="col-8 m-auto">
                    <div class="row">
                        <div class="col-4 form-group">
                            <strong>File Name</strong>
                            <input type="text" name="name" placeholder="File Name" class="form-control" value="{{ $dataInfo->name }}"  required>
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-4 form-group">
                            <strong>File:</strong>
                            <input type="file" name="file" placeholder="Level" class="form-control" >
                             <span style="color:red" ></span>
                        </div>
                        <div class="col-12 d-flex flex-row-reverse">
                            <button class="btn btn-primary btn-icon" type="submit">
                               <i data-feather='save'></i> Save
                            </button>
                            <button class="btn btn-warning btn-icon mr-1" type="reset">
                               <i data-feather='reset'></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>
