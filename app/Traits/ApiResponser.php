<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * Standard Success Response
     *
     * @param string|array $data
     * @param [type] $code
     * @return void
     */
    public function successResponse(string|array $data, int $code = Response::HTTP_OK)
    {
        return response($data, $code)->header('Content-Type', 'application/json');
    }

    /**
     * Standard Error Response by Gateway
     *
     * @param string|array $message
     * @param integer $code
     * @return void
     */
    public function errorResponse(string|array $message, int $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    /**
     * Standard Error Response by Microservices
     *
     * @param string|array $message
     * @param integer $code
     * @return void
     */
    public function errorMessage(string|array $message, int $code)
    {
        return response($message, $code)->header('Content-Type', 'application/json');
    }

    public function validResponse(string|array $data, int $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }
}