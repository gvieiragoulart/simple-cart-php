<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function sendDataWithMessage(
        string $message,
        array|Collection|JsonResource|bool $data,
        ?int $statusCode = Response::HTTP_OK
    ): JsonResponse
    {
        return response()->json(
            [
                'message' => $message,
                'content' => $data
            ],
            $statusCode
        );
    }

    protected function sendMessage(
        string $message,
        ?int $statusCode = Response::HTTP_OK
    ): JsonResponse
    {
        return response()->json(
            [
                'message' => $message
            ],
            $statusCode
        );
    }

    protected function sendPaginatedData(
        string $message,
        int $total,
        ?string $nextPage,
        JsonResource $data
    )
    {
        return response()->json(
            [
                'message' => $message,
                'total' => $total,
                'nextPageUrl' => $nextPage,
                'content' => $data
            ]
        );
    }
}
