<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Twilio\Security\RequestValidator;

use function Laravel\Prompts\error;

class TwilioRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $validator = new RequestValidator(config('twilio.auth_token'));

        $signature = $request->headers->get('X-Twilio-Signature');

        if (!$signature) response('', 403);

        logger('Validating signature', [$signature, $request->all()]);

        $isValid = $validator->validate(
            $signature,
            config('twilio.new_message_url'),
            $request->all()
        );

        if (!$isValid) response('', 403);

        return $next($request);
    }
}
