<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Controllers\Support;

use Illuminate\Http\JsonResponse;

trait JsonResponses
{
    /**
     * Return a json response.
     * @param int $code
     * @param string|array|null $message
     * @param array $data
     * @return JsonResponse
     */
    protected function json(int $code, $message = null, array $data = []): JsonResponse
    {
        if (!is_string($message)) {
            $data = $message;
            $message = '';
        }

        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * Return a success json response.
     * @param string|array|null $message
     * @param array $data
     * @return JsonResponse
     */
    protected function success($message = null, array $data = []): JsonResponse
    {
        return $this->json(0, $message, $data);
    }

    /**
     * Return a error json response.
     * @param int $code
     * @param string|array|null $message
     * @param array $data
     * @return JsonResponse
     */
    protected function error($code=1, $message = null, array $data = []): JsonResponse
    {
        if (is_string($code)){
            $data = $message;
            $message = $code;
            $code = 1;
        }
        return $this->json($code, $message, $data);
    }
}