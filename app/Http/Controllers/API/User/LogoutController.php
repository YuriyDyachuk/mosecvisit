<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\SuccessResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogoutController extends Controller
{
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return SuccessResource::make($request)->response()->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
