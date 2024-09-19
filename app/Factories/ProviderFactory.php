<?php

namespace App\Factories;

use App\Models\Provider;

class ProviderFactory
{
    public static function create()
    {
        $providers = Provider::all();
        $providerServices = [];

        foreach ($providers as $provider) {
            $providerServices[] = new GenericProviderService($provider->url);
        }

        return $providerServices;
    }
}
