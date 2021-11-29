<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response($conditionData = null, ?callable $success = null, ?callable $failed = null): JsonResponse
    {
        $response = new JsonResponse($conditionData);

        if ($success !== null && $conditionData) {
            $success($response);
        }

        if ($failed !== null && !$conditionData) {
            $failed($response);
        }

        return $response;
    }
}
