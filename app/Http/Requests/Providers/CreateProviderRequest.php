<?php

namespace App\Http\Requests\Providers;

use App\Dto\Providers\CreateProviderRequestDto;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class CreateProviderRequest extends Data
{
    #[Rule('string|min:3|max:255')]
    public string $name;

    #[Rule('string|min:15')]
    public string $url;

    #[Rule('int')]
    public int $status;

    #[Rule('string|min:3')]
    public string $durationVariable;

    #[Rule('string|min:3')]
    public string $difficultyVariable;

    public function toCreateProviderDto(): CreateProviderRequestDto
    {
        return (new CreateProviderRequestDto())
            ->setName($this->name)
            ->setUrl($this->url)
            ->setStatus($this->status)
            ->setDurationVariable($this->durationVariable)
            ->setDifficultyVariable($this->difficultyVariable);
    }
}
