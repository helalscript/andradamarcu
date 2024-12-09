<?php

use App\Models\ChatRoom;
use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('chat-room.{chatRoomId}', function ($user, $chatRoomId) {
//     return ChatRoom::where('id', $chatRoomId)
//         ->where(function ($query) use ($user) {
//             $query->where('customer_id', $user->id)
//                 ->orWhere('contractor_id', $user->id);
//         })->exists();
//     // return true;
// });