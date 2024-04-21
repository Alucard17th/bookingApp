<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\User;
class StripeController extends Controller
{
    public function handle(Request $request){
        // check if event type is customer.subscription.created
        $createdSubscriptionId = null; 
        $userId = null;
        switch ($request->type) {
            case 'customer.subscription.created':
                $subscriptionData = $request->data['object'];
                Log::debug('Stripe product ID: ', ['Product ID' => $request->data['object']['items']['data'][0]['plan']['product']]);
                $stripeProductID = $request->data['object']['items']['data'][0]['plan']['product'];
                Log::debug($request->data['object']['items']['data']);
                $product = Product::where('stripe_product_id', $stripeProductID)->first('bookings');
                $subscription = Subscription::updateOrCreate(
                    ['customer_id' => $subscriptionData['customer']],
                    [
                        'subscription_id' => $subscriptionData['id'],
                        'plan_id' => $subscriptionData['plan']['product'],
                        'start_date' => date('Y-m-d H:i:s', $subscriptionData['current_period_start']),
                        'end_date' => date('Y-m-d H:i:s', $subscriptionData['current_period_end']),
                        'trial_end' => date('Y-m-d H:i:s', $subscriptionData['trial_end']),
                        'customer_id' => $subscriptionData['customer'],
                        'bookings' => $product->bookings, // This line seems redundant. Are you sure about this?
                        'consommation' => $product->bookings, // Similarly, this line seems redundant.
                    ]
                );
                $createdSubscriptionId = $subscription->id;
                break;
            case 'checkout.session.completed':
                $sessionData = $request->data['object'];
                $userId = $sessionData['metadata']['user_id'];
                $subscription = Subscription::where('customer_id', $sessionData['customer'])->first();
                if ($subscription) {
                    $subscription->update([
                        'user_id' => $userId,
                    ]);
                    Log::debug('User Subscription', ['subscription' => $subscription]);
                }else{
                    Log::debug('Subscription not found', ['subscription' => 'Subscription not found']);
                }
                break;
           
                default:
                // Handle unknown event types or ignore them
                break;
        }
        // \Log::info('Stripe webhook: ' . print_r($payload, true));
    }
    
    //
    public function createCheckoutSession($product_id){
        \Stripe\Stripe::setApiKey('sk_test_51EJCAtA7dIeuDMDjpcXwlW5JfQztClyx1mWFFMX2dpSOn1TqEzvo1RmQGGtRobw79v0Xa7mNmwNWjrxC5pgEuHas00YbvetyAZ');
        header('Content-Type: application/json');
        $checkout_session = \Stripe\Checkout\Session::create([
        'line_items' => [[
            # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
            'price' => $product_id,
            'quantity' => 1,
        ]],
        'payment_method_collection' => 'if_required',
        'mode' => 'subscription',
        'success_url' => route('checkout.success'),
        'cancel_url' => route('checkout.cancel'),
        'metadata' => [
            'user_id' => auth()->user()->id,
        ],
        ]);
        return redirect()->to($checkout_session->url);
        // header("HTTP/1.1 303 See Other");
        // header("Location: " . $checkout_session->url);
    }

    public function checkoutSessionSuccess(){
        return view('front.checkout.success');
    }

    public function checkoutSessionCancel(){
        dd('cancel');   
    }
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
