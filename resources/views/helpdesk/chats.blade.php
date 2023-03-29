@forelse($chats as $chat)
@php
if(auth()->guard('admin')->check()){
    $isCurrentUser=auth()->guard('admin')->user()->id."-1";
}
if(auth()->guard('agent')->check()){
    $isCurrentUser=auth()->guard('agent')->user()->id."-2";
}
if(auth()->guard('buyer')->check()){
    $isCurrentUser=auth()->guard('buyer')->user()->id."-3";
}
if(auth()->guard('seller')->check()){
    $isCurrentUser=auth()->guard('seller')->user()->id."-4";
}

 if($chat->userType==1){
    $userType='admin';
    $userImage=(!is_null($chat->adminInfo))?$chat->adminInfo->avatar:'';
    $userName=(!is_null($chat->adminInfo))?$chat->adminInfo->full_name:'';
    $userColor="#28c76f";
    $userWithType=(!is_null($chat->adminInfo))?$chat->adminInfo->id."-".$chat->userType:'';
}
if($chat->userType==2){
    $userType='agent';
     $userImage=(!is_null($chat->agentInfo))?$chat->agentInfo->avatar:'';
     $userName=(!is_null($chat->agentInfo))?$chat->agentInfo->full_name:'';
     $userColor="#3518ef";
     $userWithType=(!is_null($chat->agentInfo))?$chat->agentInfo->id."-".$chat->userType:'';
}
if($chat->userType==3){
    $userType='buyer';
     $userImage=(!is_null($chat->buyerInfo))?$chat->buyerInfo->avatar:'';
     $userName=(!is_null($chat->buyerInfo))?$chat->buyerInfo->full_name:'';
     $userColor="#c41bd3";
     $userWithType=(!is_null($chat->buyerInfo))?$chat->buyerInfo->id."-".$chat->userType:'';
}
if($chat->userType==4){
    $userType='seller';
     $userImage=(!is_null($chat->sellerInfo))?$chat->sellerInfo->avatar:'';
     $userName=(!is_null($chat->sellerInfo))?$chat->sellerInfo->full_name:'';
     $userColor="#1bbfd3";
     $userWithType=(!is_null($chat->sellerInfo))? $chat->sellerInfo->id."-".$chat->userType:'';
}
if($chat->userType==5){
    $userType='guest';
    $userImage=getDefaultUserImage();
    $userName="Guest User";
    $userColor="#dd4511";
    $userWithType="1-".$chat->userType;
}
@endphp
<div class="chat {{($isCurrentUser==$userWithType) ?'':'chat-left'}}">
    <div class="chat-avatar">
        <span class="avatar box-shadow-1 cursor-pointer">
            <img src="{{getUserImage($userImage)}}" alt="avatar" height="36" width="36" />
        </span>
    </div>
    <div class="chat-body">
        <div class="chat-content">
            <p>{{$chat->message}}</p>
            <span style="font-size: 8px;">{{$chat->updated_at->diffForHumans()}}</span>
        </div>
    </div>
</div>
@empty
<div class="start-chat-area">
    <h4 class="sidebar-toggle start-chat-text">Start Conversation</h4>
</div>
@endforelse
{{--
<div class="chat chat-left">
    <div class="chat-avatar">
        <span class="avatar box-shadow-1 cursor-pointer">
            <img src="{{asset('')}}/app-assets/images/portrait/small/avatar-s-7.jpg" alt="avatar" height="36" width="36" />
        </span>
    </div>
    <div class="chat-body">
        <div class="chat-content">
            <p>Hey John, I am looking for the best admin template.</p>
            <p>Could you please help me to find it out? 🤔</p>
        </div>
    </div>
</div>
--}}