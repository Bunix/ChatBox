<!-- resources/views/chat.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Chats - {{$friend->name}}</div>

                    <div class="panel-body">
                        <chat-messages :messages="messages" :friend-id="{{$friend->id}}" v-on:initialized="setFriend"></chat-messages>
                    </div>
                    <div class="panel-footer">
                        <chat-form
                                v-on:messagesent="addMessage"
                                :user="{{ Auth::user() }}"
                                :conversation-id="{{$conversation->id}}"
                                :friend-id="{{$friend->id}}"
                        ></chat-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection