<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Sanitize rich-text (WYSIWYG) fields in a data array with HTMLPurifier,
     * stripping scripts/event handlers/unsafe markup before persisting.
     * Guards against stored XSS now that the WAF excludes these fields.
     *
     * @param  array  $data    The data array (e.g. from $request->except([...])).
     * @param  array  $fields  Keys in $data that contain user-supplied HTML.
     * @return array
     */
    protected function purifyHtmlFields(array $data, array $fields)
    {
        foreach ($fields as $field) {
            if (array_key_exists($field, $data) && is_string($data[$field])) {
                $data[$field] = clean($data[$field]);
            }
        }

        return $data;
    }
}
