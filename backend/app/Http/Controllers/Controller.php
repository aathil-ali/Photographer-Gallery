<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Respond with a success JSON structure.
     *
     * @param mixed $data    The data to be included in the response.
     * @param string $message The success message.
     * @param int $code       The HTTP status code for the response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSuccess($data, $message, $code)
    {
        return response()->json(
            [
                'success' => true,
                'data' => $data,
                'message' => $message,
            ],
            $code
        );
    }

    /**
     * Respond with an error JSON structure.
     *
     * @param string $message The error message.
     * @param int $code       The HTTP status code for the response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($message, $code)
    {
        return response()->json(
            [
                'success' => false,
                'data' => null,
                'message' => $message,
            ],
            $code
        );
    }
}
