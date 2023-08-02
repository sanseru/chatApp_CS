<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Faker\Factory as Faker;

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

        $uuidReply = $request->input('uuidData');
        $message = Chat::create([
            'message' => $request->input('message'),
            'from' => Auth::id(),
            'to' => $request->input('to'),
            'subject' => $request->input('subject'),
            'isread' => 0,
            'replyUuid' => $uuidReply,
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

    public function chat_email(Request $request)
    {
        $data = [];
        // $faker = Faker::create();

        // for ($i = 0; $i < 100; $i++) {
        //     $countMessage = rand(0, 3);

        //     $now = \Carbon\Carbon::now();
        //     $futureDate = $now->addDays(7);
        //     $dateRange = $now->format('d-m-y h:i:s') . ' - ' . $futureDate->format('d-m-y h:i:s');

        //     $email = [
        //         'id' => $i,
        //         'countMessage' => $countMessage,
        //         'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        //         'dateRange' => $dateRange,
        //         'with' => $faker->name,
        //     ];

        //     $data[] = $email;
        // }

        $dataChat = Chat::with('user', 'userFrom')
            ->where(function ($query) {
                $query->whereNull('replyUuid')->orWhere('replyUuid', '');
            })
            ->orderByDesc('created_at')
            ->get();
        foreach ($dataChat as $key => $value) {
            $email = [
                'id' => $value->uuid,
                'countMessage' => 1,
                'name' => $value->userFrom->name,
                'subject' => $value->subject,
                'dateRange' => $value->created_at->format('d-M-Y h:i:s'),
                'with' => $value->user->name,
            ];
            $data[] = $email;
        }

        // dd($data);

        return response()->json($data);
    }

    public function reply_chat_email(Request $request)
    {
        $datas = [];
        $replys = [];


        $dataChat = Chat::with('user', 'userFrom')
            ->where('uuid', $request->input('uuid'))
            ->orderByDesc('created_at')
            ->get();
        $dataChatReply = Chat::with('user', 'userFrom')
            ->where('replyUuid', $request->input('uuid'))
            ->orderBy('created_at', 'asc')
            ->get();


        foreach ($dataChatReply as $key => $valuex) {
            $replyUuids = '';
            $backreply = '';
            # code...
            $counts = Chat::with('user', 'userFrom')
                ->where('replyUuid', $valuex->uuid)
                ->orderByDesc('created_at')
                ->count();
            $dataChats = Chat::with('user', 'userFrom')
                ->where('replyUuid', $valuex->replyUuid)
                ->orderByDesc('created_at')
                ->first();

            if ($dataChats) {
                $replyUuids = $dataChats->uuid;
                $backreply = $dataChats->replyUuid;
            }

            // dd($valuex->uuid);

            $datax = [
                'id' => $valuex->uuid,
                'countMessage' => $counts,
                'name' => $valuex->userFrom->name,
                'subject' => $valuex->subject,
                'message' => $valuex->message,
                'dateRange' => $valuex->created_at->format('d-M-Y h:i:s'),
                'with' => $valuex->user->name,
                'countReply' => $counts,
                'replyUuids' => $replyUuids,
                'backReply' => $backreply,
                'from' => $valuex->from,
                'to' => $valuex->to,
                'replys' => $dataChatReply,
            ];

            $replys[] = $datax;
        }

        foreach ($dataChat as $key => $value) {
            $replyUuids = '';
            $backreply = '';
            # code...
            $counts = Chat::with('user', 'userFrom')
                ->where('replyUuid', $value->uuid)
                ->orderByDesc('created_at')
                ->count();
            $dataChats = Chat::with('user', 'userFrom')
                ->where('replyUuid', $value->replyUuid)
                ->orderByDesc('created_at')
                ->first();

            if ($dataChats) {
                $replyUuids = $dataChats->uuid;
                $backreply = $dataChats->replyUuid;
            }

            // dd($value->uuid);

            $data = [
                'id' => $value->uuid,
                'countMessage' => $counts,
                'name' => $value->userFrom->name,
                'subject' => $value->subject,
                'message' => $value->message,
                'dateRange' => $value->created_at->format('d-M-Y h:i:s'),
                'with' => $value->user->name,
                'countReply' => $counts,
                'replyUuids' => $replyUuids,
                'backReply' => $backreply,
                'from' => $value->from,
                'to' => $value->to,
                'replysss' => $replys,


            ];

            $datas[] = $data;
        }
        

        return response()->json($datas);
    }
}
