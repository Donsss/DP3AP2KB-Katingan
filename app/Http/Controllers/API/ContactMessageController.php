<?php

namespace App\Http\Controllers\API;

use App\Models\ContactMessage;

class ContactMessageController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/messages",
     * tags={"Contact Messages"},
     * summary="Get list of contact messages",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);
        return $this->sendResponse($messages, 'Messages retrieved successfully.');
    }

    /**
     * @OA\Get(
     * path="/api/messages/{id}",
     * tags={"Contact Messages"},
     * summary="Get specific message (marks as read)",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Successful operation"),
     * @OA\Response(response=404, description="Message not found")
     * )
     */
    public function show($id)
    {
        $message = ContactMessage::find($id);
        
        if (is_null($message)) {
            return $this->sendError('Message not found.');
        }

        if ($message->status == 'unread') {
            $message->update(['status' => 'read']);
        }

        return $this->sendResponse($message, 'Message retrieved successfully.');
    }

    /**
     * @OA\Delete(
     * path="/api/messages/{id}",
     * tags={"Contact Messages"},
     * summary="Delete message",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Message deleted successfully")
     * )
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return $this->sendResponse([], 'Message deleted successfully.');
    }
}