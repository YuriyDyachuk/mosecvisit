<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Users\UserQrCodeResource;
use App\Models\User;
use App\Services\API\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QrCodeController extends Controller
{
    /**
     * @var UserService
     */
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request, User $user): JsonResponse
    {
        return UserQrCodeResource::make($user->qrCode)
            ->response()->setStatusCode(Response::HTTP_OK);
    }
}
