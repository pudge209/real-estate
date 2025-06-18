<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a list of conversations.
     */
    public function index()
    {
        $conversations = Conversation::where('user_one_id', Auth::id())
            ->orWhere('user_two_id', Auth::id())
            ->with('messages')
            ->get();

        return view('chat.index', compact('conversations'));
    }

    /**
     * Show the form for creating a new conversation.
     */
    public function create($user_id)
    {
        $recipient = User::findOrFail($user_id);

        // Check if a conversation already exists between these two users
        $conversation = Conversation::where(function ($query) use ($user_id) {
            $query->where('user_one_id', Auth::id())
                  ->where('user_two_id', $user_id);
        })->orWhere(function ($query) use ($user_id) {
            $query->where('user_one_id', $user_id)
                  ->where('user_two_id', Auth::id());
        })->first();

        // If no conversation exists, create a new one
        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one_id' => Auth::id(),
                'user_two_id' => $user_id,
            ]);
        }

        return view('chat.create', compact('conversation', 'recipient'));
    }

    /**
     * Store a new message in the conversation.
     */
    public function store(Request $request, $id = null)
    {
        // If an ID is provided, find the conversation
        if ($id) {
            $conversation = Conversation::findOrFail($id);
        } else {
            // Check if a conversation already exists between these two users
            $conversation = Conversation::where(function ($query) use ($request) {
                $query->where('user_one_id', Auth::id())
                      ->where('user_two_id', $request->input('recipient_id'));
            })->orWhere(function ($query) use ($request) {
                $query->where('user_one_id', $request->input('recipient_id'))
                      ->where('user_two_id', Auth::id());
            })->first();

            // If no conversation exists, create a new one
            if (!$conversation) {
                $conversation = Conversation::create([
                    'user_one_id' => Auth::id(),
                    'user_two_id' => $request->input('recipient_id'),
                ]);
            }
        }

        // Create a new message
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'message' => $request->input('message'),
        ]);

        return redirect()->route('conversations.show', $conversation->id);
    }

    /**
     * Display the specified conversation.
     */
    public function show($id)
    {
        $conversations = Conversation::where('user_one_id', Auth::id())
            ->orWhere('user_two_id', Auth::id())
            ->with('messages')
            ->get();

        $activeConversation = Conversation::with('messages.sender')
            ->findOrFail($id);

        return view('chat.index', compact('conversations', 'activeConversation'));
    }
}
