@foreach($helpQueries as $key=>$helpQuery)
@php
    if($helpQuery->userType==1){
        $userType='admin';
        $userImage=(!is_null($helpQuery->adminInfo))? $helpQuery->adminInfo->avatar:'';
        $userName=(!is_null($helpQuery->adminInfo))? $helpQuery->adminInfo->full_name:'';
        $userColor="#28c76f";
    }
    if($helpQuery->userType==2){
        $userType='agent';
         $userImage=(!is_null($helpQuery->agentInfo))?$helpQuery->agentInfo->avatar:'';
         $userName=(!is_null($helpQuery->agentInfo))?$helpQuery->agentInfo->full_name:'';
         $userColor="#3518ef";
    }
    if($helpQuery->userType==3){
        $userType='buyer';
         $userImage=(!is_null($helpQuery->buyerInfo))? $helpQuery->buyerInfo->avatar:'';
         $userName=(!is_null($helpQuery->buyerInfo))?$helpQuery->buyerInfo->full_name:'';
         $userColor="#c41bd3";
    }
    if($helpQuery->userType==4){
        $userType='seller';
         $userImage=(!is_null($helpQuery->sellerInfo))?$helpQuery->sellerInfo->avatar:'';
         $userName=(!is_null($helpQuery->sellerInfo))?$helpQuery->sellerInfo->full_name:'';
         $userColor="#1bbfd3";
    }
    if($helpQuery->userType==5){
        $userType='guest';
        $userImage=getDefaultUserImage();
        $userName="Guest User";
        $userColor="#dd4511";
    }
    
@endphp
    <li onclick="loadCoversation('{{$helpQuery->id}}','{{$userType}}','{{$userImage}}','{{$userName}}','{{$userColor}}')">
        <span class="avatar">
            <img src="{{getUserImage($userImage)}}" height="50" width="50" alt="" />
            <span class="avatar-status-offline" style="background-color: {{$userColor}}!important;"></span>
        </span>
        <div class="chat-info flex-grow-1">
            <h5 class="mb-0">{{$userName}}</h5>
            <p class="card-text text-truncate">
                {{$helpQuery->subject}}
            </p>
        </div>
        <div class="chat-meta text-nowrap">
            <small class="float-right mb-25 chat-time">{{$helpQuery->updated_at->diffForHumans()}}</small>
            <!-- <span class="badge badge-danger badge-pill float-right">3</span> -->
        </div>
    </li>
@endforeach