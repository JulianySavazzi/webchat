<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Events\Chat\SendMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    
    public function listMessages(User $user)
    {
        //var_dump($user);
        $userFrom = Auth::user()->id;
        $userTo = $user->id;

        $messages = Message::where(
                function ($query) use ($userFrom, $userTo){
                    $query->where([
                        'from' => $userFrom,
                        'to' => $userTo
                    ]);
                }
            )->orWhere(
                function ($query) use ($userFrom, $userTo){
                    $query->where([
                        'from' => $userTo,
                        'to' => $userFrom
                    ]);
                }
                )->orderBy('created_at', 'ASC')->get();

        return response()->json([
            'messages' => $messages
         ], Response::HTTP_OK);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = new Message();
        $message->from = Auth::user()->id;
        $message->to = $request->to;
        $message->content = filter_var($request->content, FILTER_SANITIZE_SPECIAL_CHARS);
        $message->save();

        //disparar evento de mensagem para o usuario
        Event::dispatch(new SendMessage($message, $message->to));

        //return response()->json("{$message->to}.{$message->content}");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
