
 <div class="modal-dialog modal-dialog-top modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Amenity Type Update</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color: red!important;">
                <span aria-hidden="true" style="color:white;">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="row" id="ajax_form" action="{{route('admin.aminetyType.update')}}" method="POST">
                @csrf
                <input type="hidden" name="dataId" value="{{$dataInfo->id}}">
                <div class="col-6 form-group">
                    <strong>Amenity Name</strong>
                    <input type="text" name="amenity" placeholder="Amenity Name" class="form-control" value="{{ $dataInfo->amenity }}" required>
                     <span style="color:red" ></span>
                </div>
                <div class="col-6 form-group">
                    <strong>Amenity Type</strong>
                    <select name="amenityType" class="form-control" required>
                        <option value="">Select Type</option>
                        <option @if($dataInfo->amenityType =="General Amenities") selected @endif value="General Amenities">General Amenity</option>
                        <option @if($dataInfo->amenityType =="Interior Amenities") selected @endif value="Interior Amenities">Interior Amenity</option>
                        <option @if($dataInfo->amenityType =="Exterior Amenities") selected @endif value="Exterior Amenities">Exterior Amenity</option>
                    </select>
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
