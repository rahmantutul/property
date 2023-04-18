<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Country;
use App\Models\Category;
use App\Models\Neighbor;
use App\Models\Property;
use App\Models\AmenityType;
use Illuminate\Support\Str;
use App\Models\PropertyType;
use App\Models\SaveProperty;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use App\Models\PropertyAddress;
use App\Models\PropertyAmenity;
use App\Models\PropertyDetails;
use App\Models\PropertyCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PropertyImages;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    use SystemLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=Property::whereNull('deleted_at')
                ->with('agentInfo','sellerInfo','buyerInfo','typeInfo','gargaeInfo','categories','amenities');
        if(isset(request()->is_featured) && request()->is_featured==1)
            $query->where('is_featured',1);

        if(isset(request()->featured) && request()->featured==1)
            $query->where('is_featured',2);
       
        $dataList=$query->paginate(100);

        return view('admin.property_list',compact('dataList'));
    }

    public function saved()
    {
        $query= SaveProperty::with('user', 'property')->where('user_id',Auth::user()->id);
        // dd($query);
        
        // $query=Property::whereNull('deleted_at')->where('adminId',$savedId['user_id'])
        //         ->with('agentInfo','sellerInfo','buyerInfo','typeInfo','gargaeInfo','categories','amenities')->get();
        //         dd($query);
        // if(isset(request()->is_featured) && request()->is_featured==1)
        //     $query->where('is_featured',1);

        // if(isset(request()->featured) && request()->featured==1)
        //     $query->where('is_featured',2);
       
        $dataList=$query->paginate(100);

        return view('admin.saved_property_list',compact('dataList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countryList=Country::whereNull('deleted_at')->where('status',1)->get();

        $cityList=City::whereNull('deleted_at')->where('status',1)->get();
        
        $stateList=Country::whereNull('deleted_at')->where('status',1)->get();
        
        $aminetyList=AmenityType::whereNull('deleted_at')->where('status',1)->get();
        
        $categoryList=Category::whereNull('deleted_at')->where('status',1)->get();
        
        $properTypeList=PropertyType::whereNull('deleted_at')->where('status',1)->get();

        return  view('admin.property_create',compact('countryList','cityList','stateList','aminetyList','categoryList','properTypeList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        
        DB::beginTransaction();

       try{
            
            $dataInfo=new Property();

            $dataInfo->agentId=$request->agentId;

            $dataInfo->buyerId=$request->buyerId;

            $dataInfo->sellerId=$request->sellerId ;

            $dataInfo->adminId=$request->adminId;

            $dataInfo->typeId=$request->typeId;

            $dataInfo->garageTypeId=$request->garageTypeId;

            $dataInfo->title=$request->title;

            $dataInfo->mlsId=$request->mlsId;

            $dataInfo->availableDate=$request->availableDate;

            $dataInfo->expireDate=$request->expireDate;

            $dataInfo->price=$request->price;

            $dataInfo->originalPrice=$request->originalPrice;

            $dataInfo->slug=Str::slug($request->title);

            $dataInfo->virtualTour=$request->virtualTour;

            $dataInfo->previewText=$request->previewText;

            $dataInfo->isHideAddress=$request->isHideAddress;

            $dataInfo->callForPrice=$request->callForPrice;

            $dataInfo->videoUrl=$request->videoUrl;
            
            if($request->hasFile('thumbnail'))
            
                $dataInfo->thumbnail=$this->uploadPhoto($request->file('thumbnail'),'properties');
            else
                $dataInfo->thumbnail=config('app.url').'/images/no_found.png';
            
            $dataInfo->status=1;

            $dataInfo->created_at=Carbon::now();

            if($dataInfo->save()){
                
                if($request->filled('category'))
                    $propertyCategoryFlag=$this->storePropertyCategory($request->category,$dataInfo->id);
                else
                    $propertyCategoryFlag=true;

                if($request->filled('amineties'))
                    $propertyAminetiesFlag=$this->storePropertyAmineties($request->amineties,$dataInfo->id);
                else
                    $propertyAminetiesFlag=true;

                if($request->filled('images'))
                    // dd($request->images);
                    $propertyImagesFlag=$this->storePropertyImages($request->images, $dataInfo->id);
                else
                    $propertyImagesFlag=true;

                $propertyAddressFlag =$this->storePropertyAddress($request,$dataInfo->id);

                $propertyDetailsFlag=$this->storePropertyDetails($request,$dataInfo->id);

                if($propertyAddressFlag && $propertyDetailsFlag && $propertyCategoryFlag && $propertyAminetiesFlag && $propertyImagesFlag){

                    $note=$dataInfo->id."=>  Property created by ".Auth::guard('admin')->user()->name;

                    $this->storeSystemLog($dataInfo->id, 'properties',$note);

                    DB::commit();

                    return response()->json(['status'=>true ,'msg'=>'A New Property Added Successfully.!','url'=>url()->previous()]);
                }
                else{

                    DB::rollBack();

                     return response()->json(['status'=>false ,'msg'=>'Failed To Add Property.!']);
                }
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Add Property.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('PropertyController','store',$err);

            DB::commit();

            return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!']);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $countryList=Country::whereNull('deleted_at')->where('status',1)->get();

        $cityList=City::whereNull('deleted_at')->where('status',1)->get();
        
        $stateList=Country::whereNull('deleted_at')->where('status',1)->get();
        
        $aminetyList=AmenityType::whereNull('deleted_at')->where('status',1)->get();
        
        $categoryList=Category::whereNull('deleted_at')->where('status',1)->get();
        
        $properTypeList=Category::whereNull('deleted_at')->where('status',1)->get();
        $neughbours = Neighbor::whereNull('deleted_at')->where('status',1)->get();
        $dataInfo=Property::with('agentInfo','sellerInfo','buyerInfo','typeInfo','gargaeInfo','categories','amenities','propertyImages','address')->whereNull('deleted_at')->where('id',$request->dataId)->first();

        // dd($dataInfo);

        if(empty($dataInfo)){
            
            session()->flash('errMsg',"Requested Property Information Not Found.");

            return redirect()->back();
        }

        return  view('admin.property_edit',compact('countryList','cityList','stateList','aminetyList','categoryList','properTypeList','dataInfo','neughbours'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();

       try{
            
            $dataInfo=Property::find($request->dataId);

            if(empty($dataInfo)){
                DB::rollBack();
                 return response()->json(['status'=>false ,'msg'=>'Requested Property Information Not Found!']);
            }

            $dataInfo->agentId=$request->agentId;

            $dataInfo->buyerId=$request->buyerId;

            $dataInfo->sellerId=$request->sellerId;

            $dataInfo->adminId=$request->adminId;
            
            $dataInfo->typeId=$request->typeId;

            $dataInfo->garageTypeId=$request->garageTypeId;

            $dataInfo->neighbourhoodId=$request->neighbourhoodId;

            $dataInfo->title=$request->title;

            $dataInfo->mlsId=$request->mlsId;

            $dataInfo->availableDate=$request->availableDate;

            $dataInfo->expireDate=$request->expireDate;

            $dataInfo->price=$request->price;

            $dataInfo->originalPrice=$request->originalPrice;

            $dataInfo->slug=Str::slug($request->title);

            $dataInfo->virtualTour=$request->virtualTour;

            $dataInfo->previewText=$request->previewText;

            $dataInfo->isHideAddress=$request->isHideAddress;

            $dataInfo->callForPrice=$request->callForPrice;

            $dataInfo->videoUrl=$request->videoUrl;
            
            if($request->hasFile('thumbnail'))
                $dataInfo->thumbnail=$this->uploadPhoto($request->file('thumbnail'),'properties');
                
            // $dataInfo->status=1;

            $dataInfo->updated_at=Carbon::now();

            if($dataInfo->save()){

                if($request->filled('category')){
                    // dd($request->all());
                    $deletePropertyCategory=PropertyCategory::where('propertyId',$dataInfo->id)->update(['deleted_at'=>Carbon::now(),'status'=>0]);

                    $propertyCategoryFlag=$this->storePropertyCategory($request->category,$dataInfo->id);
                }
                else{
                    $propertyCategoryFlag=true;
                }
                
                if($request->filled('amineties')){
                    // dd($request->all());
                    $deletePropertyAminityFlag=PropertyAmenity::where('propertyId',$dataInfo->id)->update(['deleted_at'=>Carbon::now(),'status'=>0]);

                    $propertyAminetiesFlag=$this->storePropertyAmineties($request->amineties,$dataInfo->id);
                }
                else{
                    $propertyAminetiesFlag=true;
                }

                

                $propertyAddressDelete=PropertyAddress::where('propertyId',$dataInfo->id)->update(['deleted_at'=>Carbon::now(),'status'=>0]);

                $propertyAddressFlag =$this->storePropertyAddress($request,$dataInfo->id);

                $propertyDetailsDelete=PropertyDetails::where('propertyId',$dataInfo->id)->update(['deleted_at'=>Carbon::now(),'status'=>0]);

                $propertyDetailsFlag=$this->storePropertyDetails($request,$dataInfo->id);

                if($propertyAddressFlag && $propertyDetailsFlag && $propertyCategoryFlag && $propertyAminetiesFlag){

                    $note=$dataInfo->id."=>  Property updated by ".Auth::guard('admin')->user()->name;

                    $this->storeSystemLog($dataInfo->id, 'properties',$note);

                    DB::commit();

                    return response()->json(['status'=>true ,'msg'=>'A  Property Updated Successfully.!','url'=>url()->previous()]);
                }
                else{

                    DB::rollBack();

                     return response()->json(['status'=>false ,'msg'=>'Failed To Update Property.!']);
                }
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Update Property.!']);
            }
       }
        catch(Exception $err){

            DB::rollBack();

            $this->storeSystemError('PropertyController','update',$err);

            DB::commit();

            return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!'  ]);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        
        $dataInfo=Property::find($id);

        if(!empty($dataInfo)) {

          $dataInfo->status=0;
          
          $dataInfo->deleted_at=Carbon::now();

          if($dataInfo->save()){

            $propertyAddressDelete=PropertyCategory::where('propertyId',$dataInfo->id)->update(['deleted_at'=>Carbon::now(),'status'=>0]);

             $propertyAddressDelete=PropertyAddress::where('propertyId',$dataInfo->id)->update(['deleted_at'=>Carbon::now(),'status'=>0]);

             $propertyDetailsDelete=PropertyDetails::where('propertyId',$dataInfo->id)->update(['deleted_at'=>Carbon::now(),'status'=>0]);

                $note=$dataInfo->id."=> Property  info deleted  by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'properties',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Property Info deleted Successfully.!']);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Delete Property Info!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }

    public function storePropertyCategory($categories,$propertyId)
    {
       $count=0;
       foreach($categories as $category){

            $dataInfo=new PropertyCategory();

            $dataInfo->propertyId=$propertyId;

            $dataInfo->categoryId=$category;

            $dataInfo->created_at=Carbon::now();

            $dataInfo->status=1;

            if($dataInfo->save()){
                $count++;
            }
            else{
                $count=0;
                 break;
            }
       }
       return ($count>0);
    }
    public function storePropertyAddress($request,$propertyId)
    {
        $dataInfo=new PropertyAddress();

        $dataInfo->propertyId=$propertyId;

        $dataInfo->cityId=$request->cityId;

        $dataInfo->stateId=$request->stateId;

        $dataInfo->countryId=$request->countryId ;

        $dataInfo->streetNumber=$request->streetNumber;

        $dataInfo->streetAddressOne=$request->streetAddressOne;

        $dataInfo->streetAddressTwo=$request->streetAddressTwo;

        $dataInfo->shuitAppertment=$request->shuitAppertment;

        $dataInfo->subDivision=$request->subDivision;

        $dataInfo->longitude=$request->longitude;

        $dataInfo->latitude=$request->latitude;

        $dataInfo->subDivision=$request->subDivision;

        $dataInfo->created_at=Carbon::now();

        $dataInfo->status=1;

        return ($dataInfo->save()) ?true:false;
    }

    public function storePropertyDetails($request,$propertyId)
    {
        $dataInfo=new PropertyDetails();

        $dataInfo->propertyId=$propertyId;

        $dataInfo->numOfBedroom=$request->numOfBedroom;

        $dataInfo->numOfBathroom=$request->numOfBathroom;

        $dataInfo->totalUnit=$request->totalUnit;

        $dataInfo->squareFeet=$request->squareFeet;

        $dataInfo->lotSize=$request->lotSize;

        $dataInfo->lotAcre=$request->lotAcre;

        $dataInfo->lotType=$request->lotType;

        $dataInfo->heat=$request->heat;

        $dataInfo->cooling=$request->cooling;

        $dataInfo->fuel=$request->fuel;

        $dataInfo->status=1;

        $dataInfo->created_at=Carbon::now();

        return ($dataInfo->save()) ? true:false;
    }

    public function storePropertyAmineties($amineties,$propertyId)
    {
        $count=0;
       foreach($amineties as $amenityId){

            $dataInfo=new PropertyAmenity();

            $dataInfo->propertyId=$propertyId;

            $dataInfo->amenityId=$amenityId;

            $dataInfo->created_at=Carbon::now();

            $dataInfo->status=1;

            if($dataInfo->save()){
                $count++;
            }
            else{
                $count=0;
                 break;
            }
       }
       return ($count>0);
    }
    public function storePropertyImages($images,$propertyId)
    {
        $count=0;
       foreach($images as $image){

            $dataInfo=new PropertyImages();

            $dataInfo->propertyId=$propertyId;

            $dataInfo->type='Image';

            $dataInfo->imageUrl=$this->uploadPhoto($image,'properties');

            $dataInfo->created_at=Carbon::now();

            if($dataInfo->save()){
                $count++;
            }
            else{
                $count=0;
                 break;
            }
       }
       return ($count>0);
    }

    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        $dataInfo=Property::find($request->dataId);

        if(!empty($dataInfo)) {

          $dataInfo->status=$request->status;
          
          $dataInfo->updated_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->name." Property status changed by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'admins',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Property Status Changed Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To Change Status!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }

    public function changeFeature(Request $request)
    {
        // dd($request->is_featured);
        DB::beginTransaction();
        $dataInfo=Property::find($request->dataId);

        if(!empty($dataInfo)) {

          $dataInfo->is_featured=$request->is_featured;
          
          $dataInfo->updated_at=Carbon::now();

          if($dataInfo->save()){

                $note=$dataInfo->id."=> ".$dataInfo->name." Property Featured changed by ".Auth::guard('admin')->user()->name;

                $this->storeSystemLog($dataInfo->id, 'admins',$note);

                DB::commit();

                return response()->json(['status'=>true ,'msg'=>' Property featured requested Successfully.!','url'=>url()->previous()]);
            }
            else{

                 DB::rollBack();

                 return response()->json(['status'=>false ,'msg'=>'Failed To featured!']);
            }
        }
        else{
           return response()->json(['status'=>false ,'msg'=>'Requested Data Not Found.!']); 
        }
    }
}
