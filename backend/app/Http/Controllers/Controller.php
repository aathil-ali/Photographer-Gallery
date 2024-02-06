<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

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

    public function sendError( $message, $code)
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
