@extends('helpdesk.help_desk_layout')
@section('content')
<div class="container">
    @livewire('message', ['users' => $users, 'messages' => $messages ?? null])
</div>
@endsection