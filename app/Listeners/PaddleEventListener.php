<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Paddle\Events\WebhookReceived;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\User;

class PaddleEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        //
        if ($event->payload['event_type'] === 'subscription.created') {
            // Handle the incoming event...
            $priceInfo = $event->payload['data']['items'][0]['price'];
            $priceId = $priceInfo['id'];
            $userData = $event->payload['data']['custom_data'];
            $userId = isset($userData['user_id']) ? $userData['user_id'] : null;
            $consommable = Product::where('paddle_price_id', $priceId)->first()->bookings;

            $user = User::find($userId);
            $user->consommation = 0;
            $user->max_consommation = $consommable;
            $user->save();
            Log::info($user);
        }
    }
}
