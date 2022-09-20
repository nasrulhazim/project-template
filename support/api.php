<?php

use App\Contracts\Api;

if (! function_exists('api_exception')) {
    function api_exception(Throwable $th)
    {
        $code = $th->getCode() == 0 ? 500 : $th->getCode();

        $data = [
            'message' => $th->getMessage(),
            'code' => $code,
        ];
        if (config('app.debug')) {
            $data['trace'] = $th->getTrace();
        }

        return response()->json($data, $code);
    }
}

if (! function_exists('api_response')) {
    function api_response(Api $api)
    {
        return response()->json(
            $api->getApiResponse(request()),
            $api->getCode()
        );
    }
}

if (! function_exists('api_accept_header')) {
    function api_accept_header()
    {
        $config = config('api');

        return 'application/'
            .$config['standardsTree'].'.'
            .$config['subtype'].'.'
            .$config['version'].'+json';
    }
}
