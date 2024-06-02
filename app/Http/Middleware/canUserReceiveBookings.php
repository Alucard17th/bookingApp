<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
class canUserReceiveBookings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $id = $request->route('id');

        // Fetch the user associated with the ID
        $user = User::find($id);

        // Perform your authorization logic here
        if (!$user->canBeBooked()) {
            $data = [
                'message' => 'This user cannot receive bookings.',
                'user' => $user
            ];
            abort(403, json_encode($data));
        }

        // Pass control to the next middleware or controller action
        return $next($request);
    }
}
