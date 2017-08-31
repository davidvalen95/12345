<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Closure;
use Redirect;
class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle( $request, Closure $next ){
        if (
          $this->isReading($request) ||
          $this->runningUnitTests() ||
          $this->tokensMatch($request)
        ) {
          return $this->addCookieToResponse($request, $next($request));
        }

        // redirect the user back to the last page and show error
        return Redirect::back()->with( 'message.danger', "Your session has expired, please redo" );
    }
}
