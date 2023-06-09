@extends('helpdesk.help_desk_layout')
@section('title','Help Desk')
@section('content')
    <div class="container-fluid">
        <div class="container">
            @livewire('show', ['users' => $users, 'messages' => $messages, 'sender' => $sender])
        </div>
    </div>
@endsection