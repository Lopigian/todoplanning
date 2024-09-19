<?php

namespace App\Http\Controllers\Api;

use App\Business\Services\ProviderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Providers\CreateProviderRequest;
use App\Http\Requests\Providers\UpdateProviderRequest;
use App\Http\Responses\ApiHttpResponse;

class ProvidersController extends Controller
{
    protected $providerService;

    public function __construct(ProviderService $providerService)
    {
        $this->providerService = $providerService;
    }

    public function create(CreateProviderRequest $request): ApiHttpResponse
    {
        $result = $this->providerService->create($request->toCreateProviderDto());
        return $this->defaultResponse($result);
    }

    public function update(UpdateProviderRequest $updateProviderRequest): ApiHttpResponse
    {
        $data = $this->providerService->update($updateProviderRequest->toUpdateProviderDto());
        return $this->defaultResponse($data);
    }

    public function delete(int $id): ApiHttpResponse
    {
        $data = $this->providerService->delete($id);
        return $this->defaultResponse($data);
    }

    public function getAll(): ApiHttpResponse
    {
        $providers = $this->providerService->getAll();
        return $this->defaultResponse($providers);
    }
}
