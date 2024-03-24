<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {

        $user = $request->user();
        if ($role == 'customer' && !$request->user()->isCustomer()) {
            if ($user->role !== 'customer'){
                $user->role = 'customer';
                $user->save();
            }
            return redirect()->route('home')->with([
                'flash.type'=>'flash',
                'flash.bannerStyle' => 'warning',
                'flash.banner' => 'You need to be a customer to access this page.',
                'flash.link' => 'Become a customer',
                'flash.linkHref' => route('profile.show'),
            ]);
        } else if ($role == 'vendor' && !$request->user()->isVendor()) {
            if ($user->role !== 'vendor'){
                $user->role = 'vendor';
                $user->save();
            }
            return redirect()->route('home')->with([
                'flash.type'=>'flash',
                'flash.bannerStyle' => 'warning',
                'flash.banner' => 'You need to be a vendor to access this page.',
                'flash.link' => 'Become a vendor',
                'flash.linkHref' => route('profile.show'),
            ]);
        } else if ($role == 'admin' && !$request->user()->isAdmin()) {
            if ($user->role !== 'admin'){
                $user->role = 'admin';
                $user->save();
            }
            return redirect()->route('home')->with([
                'flash.type'=>'flash',
                'flash.bannerStyle' => 'warning',
                'flash.banner' => 'You need to be an admin to access this page.',
                'flash.link' => 'Become an admin',
                'flash.linkHref' => route('profile.show'),
            ]);
        } else if ($role == 'delivery-person' && !$request->user()->isDeliveryPerson()) {
            if ($user->role !== 'delivery-person'){
                $user->role = 'delivery-person';
                $user->save();
            }
            return redirect()->route('home')->with([
                'flash.type'=>'flash',
                'flash.bannerStyle' => 'warning',
                'flash.banner' => 'You need to be a delivery person to access this page.',
                'flash.link' => 'Become a delivery person',
                'flash.linkHref' => route('profile.show'),
            ]);
        }
        return $next($request);
    }
}
