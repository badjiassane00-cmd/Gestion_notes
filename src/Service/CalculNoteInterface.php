<?php

namespace App\Service;

interface CalculNoteInterface
{
    public function calculer(float $noteBrute, bool $penaliteAppliquee): float;
}