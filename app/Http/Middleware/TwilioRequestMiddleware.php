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

        $url = $request->fullUrl();  // Certifique-se de obter a URL completa

        // Verifique se a URL é válida antes de validar a assinatura
        $parsedUrl = parse_url($url);
        if ($parsedUrl === false || !isset($parsedUrl['scheme'])) {
            // Retorne erro ou log para a URL inválida
            return response('URL inválida', 400);
        }

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
