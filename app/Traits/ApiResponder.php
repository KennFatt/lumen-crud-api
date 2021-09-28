<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponder
{
    /**
     * A method to return normalized success response.
     *
     * Schema:
     * {
     *  "data": $data
     * }
     *
     * Status should be always 200.
     *
     * @param array $data       Send recent most data depends on the request.
     * @param int $statusCode   HTTP status code
     */
    public function responseSucceed(array $data, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            "data" => $data
        ], $statusCode);
    }

    /**
     * A method to return normalized failure response.
     *
     * Schema:
     * {
     *  "message": $message
     * }
     *
     * Status will be vary depends on the error / exception.
     *
     * @param string $errorMessage  Exception / error message
     * @param int $statusCode       HTTP status code
     */
    public function responseError(string $errorMessage, int $statusCode): JsonResponse
    {
        return response()->json([
            "message" => $errorMessage
        ], $statusCode);
    }
}
