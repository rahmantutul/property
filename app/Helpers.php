<?php

use App\Models\WebsiteInfo;


function getWebsiteInfo(){
     $websiteInfo= WebsiteInfo::first();
     return $websiteInfo;
}

/**
 * Predefined Messages
 */
define('FETCH_SUCCESS', 'Data retrieve successfully');
define('FETCH_FAIL', 'Opps! NO data available.');
define('VALIDATION_ERROR', 'Validation Error');
define('SUCCESS', 'Successfully created');
define('FAIL', 'Failed to create');
define('UPDATE_SUCCESS', 'Successfully updated');
define('UPDATE_FAIL', 'Failed to update');
define('SERVER_ERROR', 'Internal server error!');
define('DELETE_SUCCESS', 'Successfully deleted');
define('DELETE_FAIL', 'Failed to delete');
define('UNAUTHORIZED', 'These credentials do not match our records.');
define('PERMISSION_DENIED', 'Insufficient Permissions!');
define('PAGINATE_LIMIT', 10);

/**
 * common json success response
 */
if(!function_exists('respondSuccess')){
    function respondSuccess($message, $data = [], $code = 200, $status = true)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'code' => $code
        ], $code);
    }
}

/**
 * common json error response
 */

if(!function_exists('respondError')){
    function respondError($message, $messages = [], $code = 500, $status = false)
    {
        $response = [
            'status' => $status,
            'message' => $message
        ];
        !empty($messages) ? $response['errors'] = $messages : null;
        return response()->json($response, $code);
    }
}

function formatDate($date)
{
    return date('d-m-Y', strtotime($date));
}
function formatTime24Hours($time)
{
    return date('H:i:s', strtotime($time));
}
function formatTime12Hours($time)
{
    return date('h:i:s A', strtotime($time));
}
function getUserImage($url)
{
    return (!is_null($url)) ? $url : asset('images/defaultUser.png');
}
function getBannerImage($url)
{
    return (!is_null($url)) ? $url : asset('frontend/images/SearchBanner.jpg');
}
function getDefaultUserImage()
{
    return asset('images/defaultUser.png');
}
function getImage($url)
{
    return (!is_null($url)) ? $url : asset('images/no_found.png');
}
function getActiveMenuClass($routeName)
{
    return (url()->full() == route($routeName)) ? 'active' : '';
}
function getActiveInActiveStatus($status)
{
    return ($status == 1) ? 'Active' : 'Inactive';
}

function getActiveInFeatureStatus($feature)
{
    if($feature==0)
     return "Not featured";
    if($feature==1)
     return "Requested";
    if($feature==2)
     return "Featured";
}

function getShowStatus($status)
{
    return ($status == 1) ? 'Showed' : 'Not Showed';
}
function getStatusBadge($status)
{
    if ($status == 1)
        return 'badge-success';
    if ($status == 2)
        return 'badge-warning';
    if ($status == 0)
        return 'badge-danger';
}

function getShareStatusBadge($status)
{
    if ($status == 1)
        return 'badge-success';
    if ($status == 2)
        return 'badge-warning';
    if ($status == 0)
        return 'badge-danger';
}

function getFeatureBadge($feature){
    if ($feature == 2)
        return 'badge-success';
    if ($feature == 1)
        return 'badge-warning';
    if ($feature == 0)
        return 'badge-danger';
}
function getFeatureClass($feature){
    if ($feature == 2)
        return 'badge-success';
    if ($feature == 1)
        return 'badge-warning';
    if ($feature == 0)
        return 'badge-danger';
}
function getStatusChangeBtn($status)
{
    if ($status == 1)
        return 'btn-secondary';
    if ($status == 2)
        return 'btn-success';
}

function getShowStatusChangeBtn($status)
{
    if ($status == 0)
        return 'btn-secondary';
    if ($status == 1)
        return 'btn-success';
}
function getStatusChangeIcon($status)
{
    if ($status == 1)
        return "<i data-feather='x-circle'></i>";
    if ($status == 2)
        return "<i data-feather='check-circle'></i>";
}
function getShowStatusChangeIcon($status)
{
    if ($status == 0)
        return "<i data-feather='x-circle'></i>";
    if ($status == 1)
        return "<i data-feather='check-circle'></i>";
}

function getFullName($dataInfo)
{

    return $dataInfo->firstName . ' ' . $dataInfo->lastName;
}


function resizePhotoUrl($Photo1URL)
{
    return str_replace('-a.', '.', $Photo1URL);
}
