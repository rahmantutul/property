@extends('helpdesk.help_desk_layout')
@section('title','Help Desk')
@section('content')
<div class="container">
    @livewire('message', ['users' => $users, 'messages' => $messages ?? null])
</div>
@endsection