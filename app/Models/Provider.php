<?php

namespace App\Models;

use App\Models\Traits\Created;
use App\Models\Traits\Updated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use HasFactory, SoftDeletes, Created, Updated;

    protected $fillable = ['name', 'status', 'url', 'duration_variable', 'difficulty_variable'];

    function setId(int $id): static
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    function getId()
    {
        return $this->attributes['id'];
    }

    function setName(string $name): static
    {
        $this->attributes['name'] = $name;
        return $this;
    }

    function getName()
    {
        return $this->attributes['name'];
    }

    function setStatus(int $name): static
    {
        $this->attributes['status'] = $name;
        return $this;
    }

    function getStatus()
    {
        return $this->attributes['status'];
    }

    function setUrl(string $url): static
    {
        $this->attributes['url'] = $url;
        return $this;
    }

    function getUrl()
    {
        return $this->attributes['url'];
    }


    function setDurationVariable(string $durationVariable): static
    {
        $this->attributes['duration_variable'] = $durationVariable;
        return $this;
    }

    function getDurationVariable()
    {
        return $this->attributes['duration_variable'];
    }

    function setDifficultyVariable(string $difficultyVariable): static
    {
        $this->attributes['difficulty_variable'] = $difficultyVariable;
        return $this;
    }

    function getDifficultyVariable()
    {
        return $this->attributes['difficulty_variable'];
    }

    public static function findProviderById(int $id): ?self
    {
        return self::find($id);
    }

    public function deleteProvider(): bool
    {
        return $this->delete();
    }

}
