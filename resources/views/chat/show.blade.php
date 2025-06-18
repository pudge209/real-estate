<x-app-layout>
     <style>
        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-header {
            margin-bottom: 0.5rem;
        }

        .accordion-body {
            font-size: 1rem;
            color: #6c757d;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #343a40;
        }
        .space{
            margin-top: 70px;
        }
    </style>
<div class="space"></div>
<div class="container">
    <h2>Conversation with
        @if($conversation->user_one_id == Auth::id())
            {{ $conversation->userTwo->name }}
        @else
            {{ $conversation->userOne->name }}
        @endif
    </h2>

    <ul class="list-group mb-3">
        @foreach($conversation->messages as $message)
            <li class="list-group-item">
                <strong>{{ $message->sender->name }}:</strong> {{ $message->message }}
            </li>
        @endforeach
    </ul>

    <form action="{{ route('conversations.message.store', $conversation->id) }}" method="POST">
        @csrf
        <textarea name="message" rows="3" class="form-control" placeholder="Type your message..."></textarea>
        <button type="submit" class="btn btn-primary mt-2">Send</button>
    </form>
</div>
</x-app-layout>

