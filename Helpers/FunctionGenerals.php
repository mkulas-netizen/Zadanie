<?php

/**
 * @return string
 * @throws Exception
 * Auto add CSRF TOKEN INPUT FOR FORM
 */
function CSRF(): string
{
    global $csrfToken;
    return '<input type="hidden" name="CSRF_TOKEN" value="' . $csrfToken->GetCSRF() . '">';
}


/**
 * @param $path
 * @param string $base
 * @return mixed
 * ABSOLUTE URL
 */
function packageFille($path, $base = BASE_URL)
{
    $path = trim($path, '/');
    return filter_var($base . $path, FILTER_SANITIZE_URL);
}

/**
 * @param $request
 * @param $name
 * @param int $filter
 * @return string
 * Validate function request
 */
function filterInput($request, $name, $message, $filter = FILTER_SANITIZE_STRING, $required = true)
{
    if ($required == true) {
        if (isset($request[$name])) {
            if (empty($request[$name])) {
                return str_replace('_', ' ', $name) . ' must required';
            }
            if (!filter_input(INPUT_POST, $name, $filter)) {
                return str_replace('_', ' ', $name) . ' ' . $message;
            }
        }
    }
}

