<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

/*
|--------------------------------------------------------------------------
| Api Response Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

trait ApiResponse
{
    /**
     * Return a success JSON response.
     *
     * @param $data
     * @param ?string $message
     * @param int $code
     * @return JsonResponse
     */
    protected static function success($data, string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status'    => 'Success',
            'message'   => $message,
            'data'      => $data
        ], $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param string|null $message
     * @param int $code
     * @param null $data
     * @return JsonResponse
     */
    protected static function error(int $code, string $message = null, $data = null): JsonResponse
    {
        return response()->json([
            'status'    => 'Error',
            'message'   => $message,
            'data'      => $data
        ], $code);
    }
}
