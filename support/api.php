<?php

use App\Contracts\Api;

if (! function_exists('apiException')) {
    function apiException(\Throwable $th)
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

if (! function_exists('apiResponse')) {
    function apiResponse(Api $api)
    {
        return response()->json(
            $api->getApiResponse(request()),
            $api->getCode()
        );
    }
}
