@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @forelse($friends as $friend)
                        <p><a href="{{route('chats.friend', ['friend_id' => $friend->id])}}">{{$friend->name}}</a></p>
                    @empty
                        <p>Looks like its just you here!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
