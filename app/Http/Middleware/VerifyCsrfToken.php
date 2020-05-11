<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'http://localhost:8000/*',
        'http://localhost:3000/*',
        'https://yummi-ui.herokuapp.com/*'
        //'http://localhost:8000/register'
    ];
}
