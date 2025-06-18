<x-app-layout>

    <style>
        .chat-messages {
            background-color: #f0f2f5;
            padding: 20px;
            border-radius: 8px;
            height: 100%;
            overflow-y: scroll;
        }
        .chat-messages .message {
            max-width: 70%;
            margin-bottom: 15px;
            border-radius: 20px;
            padding: 10px 15px;
            position: relative;
        }
        .chat-messages .message.sent {
            background-color: #dcf8c6;
            align-self: flex-end;
        }
        .chat-messages .message.received {
            background-color: #ffffff;
            align-self: flex-start;
        }
        .chat-messages .message.sent::after {
            content: '';
            position: absolute;
            right: -10px;
            top: 10px;
            border-width: 10px;
            border-style: solid;
            border-color: #dcf8c6 transparent transparent transparent;
        }
        .chat-messages .message.received::after {
            content: '';
            position: absolute;
            left: -10px;
            top: 10px;
            border-width: 10px;
            border-style: solid;
            border-color: #ffffff transparent transparent transparent;
        }
        .list-group-item {
            border: none;
            padding: 10px;
            border-radius: 8px;
        }
        .list-group-item:hover {
            background-color: #e9ecef;
        }
        .list-group-item.active {
            background-color: #007bff;
            color: white;
        }
        .input-group {
            border-top: 1px solid #dee2e6;
        }
        .input-group input {
            border-radius: 20px 0 0 20px;
        }
        .input-group button {
            border-radius: 0 20px 20px 0;
        }
        .message-btn {
            margin-top: 10px;
        }
        .list-group-item h5 {
            margin-bottom: 0;
        }
        .list-group-item p {
            margin-bottom: 0;
        }
        .back-arrow {
            font-size: 20px;
            cursor: pointer;
            color: #007bff;
            margin-right: 10px;
        }
        .back-arrow:hover {
            color: #0056b3;
        }

        .space{
            margin-top: 70px;
        }
    </style>
<div class="space"></div>
    <div class="container-fluid">
        <div class="row no-gutters">
            <!-- Conversation List -->
            <div class="col-md-4 border-right">
                <div class="bg-light p-3 border-bottom">
                    <h4>Your Conversations</h4>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($conversations as $conversation)
                        <a href="{{ route('conversations.show', $conversation->id) }}" class="list-group-item list-group-item-action {{ request()->routeIs('conversations.show') && request()->route('id') == $conversation->id ? 'active' : '' }}">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">
                                    @if($conversation->user_one_id == Auth::id())
                                        {{ $conversation->userTwo->name }}
                                    @else
                                        {{ $conversation->userOne->name }}
                                    @endif
                                </h5>
                            </div>
                            @php
                                $lastMessage = $conversation->messages->last();
                            @endphp
                            <p class="mb-1 text-muted">{{ $lastMessage ? $lastMessage->message : 'No messages yet' }}</p>
                            <small class="text-muted">{{ $lastMessage ? $lastMessage->created_at->diffForHumans() : '' }}</small>
                        </a>
                    @empty
                        <p class="text-center mt-3">No conversations found.</p>
                    @endforelse
                </div>
            </div>

            <!-- Chat Box -->
            <div class="col-md-8">
                @if(isset($activeConversation))
                    <div class="bg-light p-3 border-bottom d-flex align-items-center">
                        <a href="{{ route('conversations.index') }}" class="back-arrow">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h4 class="mb-0">
                            Chatting with
                            @if($activeConversation->user_one_id == Auth::id())
                                {{ $activeConversation->userTwo->name }}
                            @else
                                {{ $activeConversation->userOne->name }}
                            @endif
                        </h4>
                    </div>
                    <div class="chat-messages">
                        @foreach($activeConversation->messages as $message)
                            <div class="d-flex mb-4 {{ $message->sender_id == Auth::id() ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="message {{ $message->sender_id == Auth::id() ? 'sent' : 'received' }}">
                                    <p class="mb-0">{{ $message->message }}</p>
                                    <small class="text-muted">{{ $message->created_at->format('h:i A') }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Message Input -->
                    <div class="bg-light p-3 border-top">
                        <form action="{{ route('conversations.message.store', $activeConversation->id) }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="message" class="form-control" placeholder="Type a message" required>
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                @else
                    <div class="text-center p-5">
                        <h4>Select a conversation to start chatting</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </x-app-layout>
