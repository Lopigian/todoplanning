<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiHttpResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected ApiHttpResponse $response;

    public function defaultResponse(mixed $data): ApiHttpResponse
    {
        return new ApiHttpResponse($data);
    }
}
