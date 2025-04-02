<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key and Organization
    |--------------------------------------------------------------------------
    |
    | Here you may specify your OpenAI API Key and organization. This will be
    | used to authenticate with the OpenAI API - you can find your API key
    | and organization on your OpenAI dashboard, at https://openai.com.
    */

    'api_key' => env('OPENAI_API_KEY', base64_decode('c2stcHJvai1kNlc4cFItdWYyUFBWcWtpV0dEVEVGWUdHT2huM2FFRFJDMFpiREVyVDZ2VU9HbjM1b0Y3YW9QdVkyT0FnNEVsbG95cFBEZ09nclQzQmxia0ZKUFhtUkd5VFJOUE9pSDBEaExYQldPSjc1OVB4VWJIN3AzbTliQi1nX25nRnM1WHJONGRYcHpwUjBzWU1LdEg4VU1EeVZnV051Z0E=')),
    'organization' => env('OPENAI_ORGANIZATION'),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    |
    | The timeout may be used to specify the maximum number of seconds to wait
    | for a response. By default, the client will time out after 30 seconds.
    */

    'request_timeout' => env('OPENAI_REQUEST_TIMEOUT', 30),
];
