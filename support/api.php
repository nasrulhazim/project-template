<?php

use App\Contracts\Api;

if (! function_exists('apiException')) {
    function apiException(\Throwable $th)
    {
        $data = [
            'message' => $th->getMessage(),
            'code' => $th->getCode(),
        ];
        if (config('app.debug')) {
            $data['trace'] = $th->getTrace();
        }

        return response()->json($data, $th->getCode());
    }
}

if (! function_exists('apiResponse')) {
    function apiResponse(Api $api)
    {
        return response()->json(
            $api->getApiResponse(),
            $api->getCode()
        );
    }
}
