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
    <h2>Send a Message to {{ $recipient->name }}</h2>
    <form action="{{ route('conversations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="recipient_id" value="{{ $recipient->id }}">
        <div class="form-group">
            <textarea name="message" class="form-control" rows="4" placeholder="Type your message here..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Send Message</button>
    </form>

</div>

</x-app-layout>
