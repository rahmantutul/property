<?php

namespace App\Http\Controllers;

use Exception;
use App\Common\Store;
use App\Common\Common;
use App\Models\OreGon;
use App\Models\ResoapiProperties;
use Illuminate\Support\Facades\DB;

class OreGonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $query = OreGon::latest();
        $dataList = $query->paginate(100);
        return view('admin.metadata_list',compact('dataList'));
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        try {
            //fetch meta data from api
            $metaDataList = Common::APIWiseFetchableMetaData();
            //fetch existing meta data
            $existingValues = $this->getExistingMetaData();
            //foreach loop for metadata add from api
            if (!empty($metaDataList)) {
                foreach ($metaDataList['value'] as $key => $metadata) {
                    //Store meta data into database
                    $data = Store::storeMetaData($metadata, $existingValues);
                }
            }
            if ($data) {
                // return response()->json(['status'=>true ,'msg'=>'Data Added Successsfully.!']);
                return redirect('/admin/metadata')->with('status', 'Data Added Successsfully!');
            } else {
                // return response()->json(['status'=>true ,'msg'=>'Meta data already exists!','url'=>url()->previous()]);
                return redirect('/admin/metadata')->with('status', 'Meta data already exists!');

            }
        } catch (Exception $e) {
            // return response()->json(['status'=>true ,'msg'=>'Failed to found API Data']);
            return redirect('/admin/metadata')->with('status', 'Failed to found API Data!');
        }
    }

     /**
     * Retrieve existing isting of the resource.
     */
    public function getExistingMetaData()
    {
        // Retrieve existing values from the database or any other data source
        $existingValues = DB::table('ore_gons')->pluck('url')->toArray();
        return $existingValues;
    }

}
