<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\Notifications;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
	public function getNotifications($userId): JsonResponse
	{
		$notification = NotificationResource::collection(Notifications::with('user')->where('user_to_notify', $userId)->orderByDesc('id')->get());
		return response()->json($notification, 201);
	}
}
