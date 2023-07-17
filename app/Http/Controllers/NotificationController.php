<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
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

	public function readNotification(NotificationRequest $request): JsonResponse
	{
		if ($request['id']) {
			$notification = Notifications::find($request['id']);
			$notification->seen_by_user = true;
			$notification->save();
		} elseif ($request['all']) {
			$notifications = Notifications::all();
			foreach ($notifications as $notification) {
				$notification->seen_by_user = true;
				$notification->save();
			}
		}
		return response()->json(['message'=> 'sucessfully read notification'], 200);
	}
}
