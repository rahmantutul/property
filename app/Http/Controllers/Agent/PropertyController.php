<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SystemLogTrait;
use App\Models\Property;
use App\Models\Country;
use App\Models\City;
use App\Models\AmenityType;
use App\Models\Category;
use App\Models\PropertyType;
use App\Models\PropertyCategory;
use App\Models\PropertyAddress;
use App\Models\PropertyDetails;
use App\Models\PropertyAmenity;
use Illuminate\Support\Str;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

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
        $query=Property::whereNull('deleted_at')->where('agentId',Auth::guard('agent')->user()->id)
                    ->with('agentInfo','sellerInfo','buyerInfo','typeInfo','gargaeInfo','categories','amenities');

        $dataList=$query->paginate(100);

        return view('agent.property_list',compact('dataList'));
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

        return  view('agent.property_create',compact('countryList','cityList','stateList','aminetyList','categoryList','properTypeList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        DB::beginTransaction();

       try{
            
            $dataInfo=new Property();

            $dataInfo->agentId=Auth::guard('agent')->user()->id;

            $dataInfo->buyerId=$request->buyerId;

            $dataInfo->sellerId=$request->sellerId ;

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
                $dataInfo->thumbnail=env('APP_URL').'/images/no_found.png';
            
            $dataInfo->status=2;

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

                $propertyAddressFlag =$this->storePropertyAddress($request,$dataInfo->id);

                $propertyDetailsFlag=$this->storePropertyDetails($request,$dataInfo->id);

                if($propertyAddressFlag && $propertyDetailsFlag && $propertyCategoryFlag && $propertyAminetiesFlag){

                    $note=$dataInfo->id."=>  Property created by ".Auth::guard('agent')->user()->name;

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

        $dataInfo=Property::with('agentInfo','sellerInfo','buyerInfo','typeInfo','gargaeInfo','categories','amenities','propertyImages','address')->whereNull('deleted_at')->where('id',$request->dataId)->first();

        // dd($dataInfo);

        if(empty($dataInfo)){
            
            session()->flash('errMsg',"Requested Property Information Not Found.");

            return redirect()->back();
        }

        return  view('agent.property_edit',compact('countryList','cityList','stateList','aminetyList','categoryList','properTypeList','dataInfo'));
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

            $dataInfo->sellerId=$request->sellerId ;

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

                    $note=$dataInfo->id."=>  Property updated by ".Auth::guard('agent')->user()->name;

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

            return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!']);
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

                $note=$dataInfo->id."=> Property  info deleted  by ".Auth::guard('agent')->user()->name;

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
    
}
