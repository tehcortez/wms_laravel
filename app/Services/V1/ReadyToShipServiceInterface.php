<?php

namespace App\Services\V1;

interface ReadyToShipServiceInterface
{
    public function updateAllReadyToShipFlags(): void;
}
