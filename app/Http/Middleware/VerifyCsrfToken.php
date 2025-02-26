<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        'contact-form',
        'registration',
        'go_out',
        'auth_form',
        'https://api.openweathermap.org/data/2.5/weather/*'
    ];
}
