<?php
namespace App\Business\Interfaces;

use App\Dto\Providers\CreateProviderRequestDto;
use App\Dto\Providers\GetDetailedProviderResponseDto;
use App\Dto\Providers\UpdateProviderRequestDto;
use Illuminate\Support\Collection;

interface IProviderService
{
    function create(CreateProviderRequestDto $createProviderRequestDto) :bool;

    function update(UpdateProviderRequestDto $updateProviderRequestDto) :bool;

    function delete(int $id) :bool;

    function getAll() :Collection;

    function getById(int $id) :GetDetailedProviderResponseDto;

}
