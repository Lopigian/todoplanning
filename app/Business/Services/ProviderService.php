<?php

namespace App\Business\Services;

use App\Dto\Providers\CreateProviderRequestDto;
use App\Dto\Providers\GetDetailedProviderResponseDto;
use App\Dto\Providers\UpdateProviderRequestDto;
use App\Exceptions\HttpHasMatchExceptions;
use App\Models\Provider;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use App\Business\Interfaces\IProviderService;
use Illuminate\Support\Facades\Http;

class ProviderService implements IProviderService
{
    function create(CreateProviderRequestDto $createProviderRequestDto): bool
    {
        $this->validate($createProviderRequestDto);

        $provider = new Provider();
        return $provider->setName($createProviderRequestDto->getName())
            ->setStatus($createProviderRequestDto->getStatus())
            ->setUrl($createProviderRequestDto->getUrl())
            ->setDifficultyVariable($createProviderRequestDto->getDifficultyVariable())
            ->setDurationVariable($createProviderRequestDto->getDurationVariable())
            ->setDurationVariable($createProviderRequestDto->getDurationVariable())
            ->save();
    }

    function update(UpdateProviderRequestDto $updateProviderRequestDto): bool
    {
        $this->validate($updateProviderRequestDto);

        $provider = Provider::findProviderById($updateProviderRequestDto->id);
        if(is_null($provider)){
            throw new HttpHasMatchExceptions("Provider not found or deleted!");
        }
        $provider->fill($updateProviderRequestDto->toArray());
        return $provider->save();
    }

    function delete(int $id): bool
    {
        $provider = Provider::findProviderById($id);
        if(!$provider) {
            throw new HttpHasMatchExceptions("Provider not found!");
        }
        return $provider->deleteProvider();
    }

    function getAll(): Collection
    {
        return Provider::all();
    }

    function getById(int $id): GetDetailedProviderResponseDto
    {
        $provider = Provider::findProviderById($id);
        if(is_null($provider)){
            throw new HttpHasMatchExceptions("Provider not found or deleted!");
        }
        return new GetDetailedProviderResponseDto($provider);
    }

    public function validate($providerData): void
    {
        $query = Provider::query();

        if (isset($providerData->id)) {
            $query->where('id', '!=', $providerData->id);
        }

        $query->where(function (Builder $query) use ($providerData) {
            $query->where('name', '=', $providerData->getName());
        });

        if ($query->exists()) {
            throw new HttpHasMatchExceptions("Provider has a matching record in the database.");
        }
    }

    public function fetchTasks(Provider $provider) {

        $response = Http::get($provider->url);

        if ($response->successful()) {
            $tasksData = $response->json();

            foreach ($tasksData as $taskData) {

                $duration = $taskData[$provider->duration_variable];
                $difficulty = $taskData[$provider->difficulty_variable];

                Task::create([
                    'name' => $provider->name,
                    'duration' => $duration,
                    'difficulty' => $difficulty,
                    'provider_id' => $provider->id
                ]);
            }
        }
    }
}
