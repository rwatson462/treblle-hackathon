<?php

if (! function_exists('authUser')) {
    function authUser(): \App\Models\User {
        assert(auth()->user() !== null);

        return auth()->user();
    }
}
