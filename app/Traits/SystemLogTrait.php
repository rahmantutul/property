<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\SystemLog;
use App\Models\SystemError;
use Carbon\Carbon;
use Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait SystemLogTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function storeSystemLog($dataId, $dataTable, $note ) {

        $logInfo=new SystemLog();

        // $logInfo->staffId=Auth::guard('staff')->user()->id;

        $logInfo->staffId=1;

        $logInfo->dataId=$dataId;

        $logInfo->referenceTable=$dataTable;

        $logInfo->note=$note;

        $logInfo->created_at=Carbon::now();

        return ($logInfo->save()) ? true:false;

    }
    public function storeSystemError($controller,$function,$log) {

        $logInfo=new SystemError();

        $logInfo->controller=$controller;

        $logInfo->function=$function;

        $logInfo->log=substr($log,0,1000);

        $logInfo->created_at=Carbon::now();

        return ($logInfo->save()) ? true:false;

    }

    public function uploadPhoto($image,$folder)
    {
        // $image=$request->file('photo');

        $imageName = uniqid(). "." . $image->getClientOriginalExtension();

        if (!Storage::disk('public')->exists($folder)) {
        Storage::disk('public')->makeDirectory($folder);
        }

        $note_img = Image::make($image)->stream();

        Storage::disk('public')->put($folder.'/' . $imageName, $note_img);

        $path = '/storage/app/public/'.$folder.'/'.$imageName;

        return config('app.url').$path;
    }

    public function seedBookingRequestValidation($request)
    {
        foreach($request->farmers as $key=>$farmer){

        }
    }
    public function fileUpload($file,$folder)
    {
        $fileName = uniqid(). "." . $file->getClientOriginalExtension();

        if (!Storage::disk('public')->exists($folder)) {
            
            Storage::disk('public')->makeDirectory($folder);
        }
        Storage::disk('public')->put($folder.'/'.$fileName, $file);

        $path = '/storage/app/public/'.$folder.'/'.$fileName;

        return env('APP_URL').$path;
    }

}