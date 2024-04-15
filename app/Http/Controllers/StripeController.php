<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\User;
class StripeController extends Controller
{
    //
    public function getUserSubscription()
    {
        $stripe = new \Stripe\StripeClient('sk_test_51EJCAtA7dIeuDMDjpcXwlW5JfQztClyx1mWFFMX2dpSOn1TqEzvo1RmQGGtRobw79v0Xa7mNmwNWjrxC5pgEuHas00YbvetyAZ');
        // return $stripe->customers->retrieve('cus_PupH4hk0ubmTXq', [])->email;
        return $stripe->subscriptions->retrieve('sub_1P4ytmA7dIeuDMDj6JyehIZC', []);

        // return $stripe->subscriptions->all(['limit' => 3]);
        
    }

    public function customerSubscriptionCreated(Request $request)
    {
        // Log the event
        \Log::info('Stripe webhook: customer.subscription.created');

        // Access the event data from the request body (assuming JSON)
        $payload = json_decode($request->getContent(), true);

        if (!$payload || !isset($payload['data'])) {
            \Log::error('Invalid Stripe webhook data');
            return response()->json(['message' => 'Invalid data'], 400);
        }

        $data = $payload['data'];

        // Extract relevant data from the event
        $customerId = $data['object']['customer'];
        $subscriptionId = $data['object']['id'];
        $planId = $data['object']['plan']['id'];
        $quantity = $data['object']['items']['data'][0]['quantity'];
        $startDate = $data['object']['current_period_start'];
        $endDate = $data['object']['current_period_end'];

        // Optional: Extract trial information (check for existence first)
        $trialEnd = null;
        if (isset($data['object']['trial_settings']['end_behavior'])) {
            $trialEnd = $data['object']['trial_settings']['end_behavior'];
        }

        $stripe = new \Stripe\StripeClient('sk_test_51EJCAtA7dIeuDMDjpcXwlW5JfQztClyx1mWFFMX2dpSOn1TqEzvo1RmQGGtRobw79v0Xa7mNmwNWjrxC5pgEuHas00YbvetyAZ');
        $customerEmail = $stripe->customers->retrieve($customerId, [])->email;

        // Configure Stripe with your secret key

        try {
            $subscription = Subscription::create([
                'subscription_id' => $subscriptionId,
                'customer_id' => $customerId,
                'plan_id' => $planId,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'trial_end' => $trialEnd,
            ]);

            $user = User::firstOrCreate([
                'email' => $customerEmail,
            ], [
                // User attributes (e.g., name, email)
            ]);
            
            $user->update([
                'subscription_id' => $subscriptionId, // Update user with subscription ID (optional)
            ]);

            \Log::info('Subscription created successfully for customer ' . $customerId);
            return response()->json(['message' => 'Subscription created'], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating subscription: ' . $e->getMessage());
            return response()->json(['message' => 'Subscription creation failed'], 500);
        }
    }
}
