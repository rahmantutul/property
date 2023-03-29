<?php

namespace App\Http\Controllers\Api;

use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Guzzle\Http\Exception\ClientErrorResponseException;

class PropertyController extends Controller
{
    public function index(){
        $client = new \GuzzleHttp\Client([
          'base_uri' => 'https://resoapi.rmlsweb.com/reso/odata/',
          'headers' => [
              'Authorization' => 'Bearer ac82e3e1bc0016aca5529cf4577d0093',
              'Accept' => 'application/json'
          ]
      ]);
      $response = $client->get('Property');

      $data = json_decode($response->getBody(), true);

      return $data['value'][0];

    }


    public function store(){

        try{

            $client = new \GuzzleHttp\Client([
                'base_uri' => 'https://resoapi.rmlsweb.com/reso/odata/',
                'headers' => [
                    'Authorization' => 'Bearer ac82e3e1bc0016aca5529cf4577d0093',
                    'Accept' => 'application/json'
                ]
            ]);

            $response = $client->get('Property');

            $dataList = json_decode($response->getBody(), true);
            // return response()->json($dataList['value'][0]);
            //save data in database from api
            Property::create([
                'availableDate' => $dataList['value'][0]['OnMarketDate'],
                'expireDate' => $dataList['value'][0]['CloseDate'],
                'price' => $dataList['value'][0]['ListPrice'],
                'originalPrice' => $dataList['value'][0]['OriginalListPrice'],
                'previewText' => $dataList['value'][0]['PublicRemarks'],
                // 'callForPrice' => $dataList['value'][0]['AuctionAssessedPrice'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // foreach($dataList['value'][0] as $key=>$dataItem){
            //     // $dataItem = (array)$dataItem;
            //     // dd($dataInfo);


            //     $dataInfo=new Property();

            //     // $dataInfo->agentId=$request->agentId;

            //     // $dataInfo->buyerId=$request->buyerId;

            //     // $dataInfo->sellerId=$request->sellerId;

            //     // $dataInfo->typeId=$request->typeId;

            //     // $dataInfo->garageTypeId=$request->garageTypeId;

            //     // $dataInfo->title= $dataItem->title;

            //     // $dataInfo->mlsId=$request->mlsId;

            //     $dataInfo->availableDate= $dataItem->OnMarketDate;

            //     $dataInfo->expireDate= $dataItem->CloseDate;

            //     $dataInfo->price= $dataItem->ListPrice;

            //     $dataInfo->originalPrice= $dataItem->OriginalListPrice;

            //     // $dataInfo->slug= Str::slug($dataItem->title);

            //     // $dataInfo->virtualTour=$request->virtualTour;

            //     $dataInfo->previewText= $dataItem->PublicRemarks;

            //     // $dataInfo->isHideAddress=$request->isHideAddress;

            //     $dataInfo->callForPrice= $dataItem->AuctionAssessedPrice;

            //     // $dataInfo->videoUrl=$request->videoUrl;

            //     if($dataItem->hasFile('thumbnail'))
            //         $dataInfo->thumbnail=$this->uploadPhoto($dataItem->file('thumbnail'),'properties');
            //     else
            //         $dataInfo->thumbnail=env('APP_URL').'/images/no_found.png';

            //     $dataInfo->status=1;

            //     $dataInfo->created_at= Carbon::now();

            //     $dataInfo->updated_at= Carbon::now();

            //     $dataInfo->save();

                // if($dataInfo->save()){

                //     if($request->filled('category'))
                //         $propertyCategoryFlag=$this->storePropertyCategory($request->category,$dataInfo->id);
                //     else
                //         $propertyCategoryFlag=true;

                //     if($request->filled('amineties'))
                //         $propertyAminetiesFlag=$this->storePropertyAmineties($request->amineties,$dataInfo->id);
                //     else
                //         $propertyAminetiesFlag=true;

                //     $propertyAddressFlag =$this->storePropertyAddress($request,$dataInfo->id);

                //     $propertyDetailsFlag=$this->storePropertyDetails($request,$dataInfo->id);

                //     if($propertyAddressFlag && $propertyDetailsFlag && $propertyCategoryFlag && $propertyAminetiesFlag){

                //         $note=$dataInfo->id."=>  Property created by ".Auth::guard('admin')->user()->name;

                //         $this->storeSystemLog($dataInfo->id, 'properties',$note);

                //         DB::commit();

                //         return response()->json(['status'=>true ,'msg'=>'A New Property Added Successfully.!','url'=>url()->previous()]);
                //     }
                //     else{

                //         DB::rollBack();

                //         return response()->json(['status'=>false ,'msg'=>'Failed To Add Property.!']);
                //     }
            //  }
            // else{

            //      DB::rollBack();

            //      return response()->json(['status'=>false ,'msg'=>'Failed To Add Property.!']);
            // }
            // }
       }
        catch(\Exception $err){

            DB::rollBack();

            $this->storeSystemError('PropertyController','store',$err);

            DB::commit();

            return response()->json(['status'=>false ,'msg'=>'Something Went Wrong.Please Try Again.!']);
       }
    }

}


