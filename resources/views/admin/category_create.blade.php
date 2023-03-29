<div class="modal-dialog modal-dialog-top modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Category Entry</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color: red!important;">
                <span aria-hidden="true" style="color:white;">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="row" id="ajax_form" action="{{route('admin.category.store')}}" method="POST">
                @csrf
                <div class="col-12 form-group">
                    <strong>Category Name</strong>
                    <input type="text" name="name" placeholder="Category Name" class="form-control" required>
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
            </form>
        </div>
        
    </div>
</div>
