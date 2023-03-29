<?php

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
