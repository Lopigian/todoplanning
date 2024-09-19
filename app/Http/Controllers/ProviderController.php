<?php

namespace App\Http\Controllers;

use App\Business\Interfaces\IProviderService;

class ProviderController extends Controller
{
    private IProviderService $providerService;

    public function __construct(IProviderService $providerService)
    {
        $this->providerService = $providerService;
    }

    public function index()
    {
        $providers = $this->providerService->getAll();
        return view('providers.index', compact('providers'));
    }
}
