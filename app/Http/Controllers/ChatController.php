<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('chat.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messageContent = $request->input('message');

        $message = Chat::create([
            'message' => $request->input('message'),
            'from' => Auth::id(),
            'to' => $request->input('to'),
        ]);
        $chatId = $message->id;

        $data = Chat::with('user', 'userFrom')->where('id',$chatId)->first();
        return response()->json(['status' => 'success', 'message' => $data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }

    public function chat(Request $request)
    {
        $userId = $request->input('user');
        // $selfId = Auth::id();
        $data = Chat::with('user', 'userFrom')
            ->when($userId, function ($query, $userId) {
                return $query->where('from', $userId)
                    ->orWhere('from', Auth::id())
                    ->whereIn('to', [$userId, Auth::id()]);
            })
            ->orderBy('created_at', 'asc')
            ->get();
        return $data;
    }
}
