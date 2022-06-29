<?php

namespace App\Services;

use App\Models\Position;

class PositionsService
{
    public function getPositions()
    {
        return Position::all();
    }
}
