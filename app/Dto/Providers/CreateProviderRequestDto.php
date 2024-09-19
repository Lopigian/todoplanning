<?php

namespace App\Dto\Providers;

use Spatie\LaravelData\Data;

class CreateProviderRequestDto extends Data
{

    public string $name;
    public string $url;
    public int $status;
    public string $difficultyVariable;
    public string $durationVariable;

    /**
     * @param string $name
     * @return $this
     */
    function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $url
     * @return $this
     */
    function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param int $status
     * @return $this
     */
    function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param string $durationVariable
     * @return $this
     */
    function setDurationVariable(string $durationVariable): self
    {
        $this->durationVariable = $durationVariable;
        return $this;
    }

    /**
     * @return string
     */
    function getDurationVariable(): string
    {
        return $this->durationVariable;
    }

    /**
     * @param string $difficultyVariable
     * @return $this
     */
    function setDifficultyVariable(string $difficultyVariable): self
    {
        $this->difficultyVariable = $difficultyVariable;
        return $this;
    }

    /**
     * @return string
     */
    function getDifficultyVariable(): string
    {
        return $this->difficultyVariable;
    }
}
