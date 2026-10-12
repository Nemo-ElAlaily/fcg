<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DecodeBase64Fields
{
    /**
     * Decode Base64-encoded form fields that were encoded in the browser to get
     * past the host's ModSecurity WAF.
     *
     * WYSIWYG (Summernote) HTML trips mod_security's XSS rules, and those rules
     * run on the raw request body before Laravel sees it, so server-side
     * sanitization cannot help. The client Base64-encodes the affected fields
     * (so the WAF sees an opaque blob) and lists their names in `_b64_fields`.
     * Here we decode them back to raw HTML before validation and before the
     * controller sanitizes the result with HTMLPurifier (clean()).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $fields = $request->input('_b64_fields');

        if (is_string($fields) && $fields !== '') {
            $decoded = [];

            foreach (array_filter(explode(',', $fields)) as $name) {
                $name  = trim($name);
                $value = $request->input($name);

                if ($name !== '' && is_string($value) && $value !== '') {
                    // Strict decode; UTF-8 safe to pair with the client's
                    // btoa(unescape(encodeURIComponent(...))) encoding.
                    $plain = base64_decode($value, true);

                    if ($plain !== false) {
                        $decoded[$name] = $plain;
                    }
                }
            }

            if ($decoded) {
                $request->merge($decoded);
            }
        }

        // The marker is transport-only: drop it so it never reaches validation
        // or a mass-assigned ($guarded = []) model insert.
        $request->request->remove('_b64_fields');
        $request->query->remove('_b64_fields');

        return $next($request);
    }
}
