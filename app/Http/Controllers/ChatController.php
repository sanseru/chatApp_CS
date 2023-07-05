<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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
            'isread' => 0,
        ]);
        $chatId = $message->id;

        $data = Chat::with('user', 'userFrom')
            ->where('id', $chatId)
            ->first();
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
        $searchInput = $request->input('searchInput');
        $search = $request->input('search');
        $filter = $request->input('filter');
        $dateFilter = $request->input('days');

        $data = Chat::with('user', 'userFrom')
            ->when($dateFilter, function ($query) use ($dateFilter) {
                $now = now()->startOfDay();
                if ($dateFilter === '1') {
                    $date = $now->subDays(6);
                    return $query->where('created_at', '>=', $date);
                } elseif ($dateFilter === '2') {
                    return $query->where('created_at', '>=', $now);
                } elseif ($dateFilter === '3') {
                    $yesterday = $now->subDay();
                    return $query->whereBetween('created_at', [$yesterday, $now]);
                } elseif ($dateFilter === '4') {
                    $oneMonthAgo = $now->subMonth();
                    return $query->where('created_at', '>=', $oneMonthAgo);
                } elseif ($dateFilter === '5') {
                    $twoMonthsAgo = $now->subMonths(2);
                    return $query->where('created_at', '>=', $twoMonthsAgo);
                }
            })
            ->when($userId, function ($query, $userId) {
                return $query->where(function ($query) use ($userId) {
                    return $query
                        ->where(function ($query) use ($userId) {
                            $query->where('chats.from', $userId)->where('chats.to', Auth::id());
                        })
                        ->orWhere(function ($query) use ($userId) {
                            $query->where('chats.from', Auth::id())->where('chats.to', $userId);
                        });
                });
            })
            ->when($filter == true && $searchInput, function ($query) use ($searchInput) {
                return $query->where('message', 'like', '%' . $searchInput . '%');
            })       
            ->orderBy('created_at', 'asc')
            ->get();

        $this->readChat();

        return $data;
    }

    public function unRead(Request $request)
    {
        $data = Chat::latest()
            ->where('to', Auth::id())
            ->where('isread', 0)
            ->take(100)
            ->count();
        return $data;
    }

    public function readChat()
    {
        return Chat::where('to', Auth::id())
            ->where('isread', 0)
            ->update(['isread' => 1]);
    }

    public function uploadFileChat(Request $request)
    {
        if ($request->hasFile('fileInput')) {
            $file = $request->file('fileInput');
            $filename = $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public'); // Save the file to the 'uploads' folder

            $message = Chat::create([
                'message' => $filename,
                'from' => Auth::id(),
                'to' => $request->input('to'),
                'isread' => 0,
                'is_file' => 1,
            ]);

            return 'File uploaded successfully.';
        } else {
            return 'No file selected.';
        }
    }

    // public function fileRead(){
    //     $url = Storage::url(public_path('uploads/'));
    // }
}
