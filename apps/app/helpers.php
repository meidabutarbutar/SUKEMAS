<?php

use App\Models\Tenant;
use App\Models\User;

if (!function_exists('skm_loggedInUser')) {
    function skm_loggedInUser(): ?User
    {
        if (!auth()->hasUser()) {
            return null;
        }

        return auth()->user();
    }
}

if (!function_exists('skm_loggedInOperator')) {
    function skm_loggedInOperator(): ?User
    {
        return skm_loggedInUser();
    }
}

if (!function_exists('skm_tenant')) {
    function skm_tenant(): ?Tenant
    {
        $user = skm_loggedInUser();

        $token = session('tenant.token');

        if ($user) {
            return $user->tenant;
        }

        if ($token) {
            return Tenant::where('token', $token)->first();
        }

        return null;
    }
}

if (!function_exists('skm_hasTenant')) {
    function skm_hasTenant(): ?bool
    {
        return skm_tenant() !== null;
    }
}
