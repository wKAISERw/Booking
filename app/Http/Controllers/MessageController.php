<?php


namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function userIndex()
    {
        // Отримуємо всіх адміністраторів
        $admins = User::where('role', 'admin')->get();

        return view('messages.user', compact('admins'));
    }

    public function adminIndex()
    {
        // Отримуємо всіх користувачів, які писали адміну
        $users = User::whereHas('sentMessages', function ($query) {
            $query->where('receiver_id', auth()->id());
        })->where('id', '!=', auth()->id())->get(); // Виключаємо самого адміністратора

        return view('messages.admin', compact('users'));
    }



    public function chat($id)
    {
        $chatUser = User::findOrFail($id);

        // Завантажуємо повідомлення між авторизованим користувачем і вибраним
        $messages = Message::where(function ($query) use ($id) {
            $query->where('sender_id', auth()->id())->where('receiver_id', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender_id', $id)->where('receiver_id', auth()->id());
        })->orderBy('created_at')->get();

        return view('messages.chat', compact('chatUser', 'messages'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'receiver_id' => 'required|exists:users,id',
        ]);

        // Створення нового повідомлення
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        // Відправка події через Laravel Echo
        broadcast(new \App\Events\MessageSent(auth()->user(), $message))->toOthers();


        return response()->json(['success' => true]);
    }
}
