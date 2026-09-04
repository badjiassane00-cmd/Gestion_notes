<?php

namespace App\Service;

use App\DTO\SoumettreCopieDTO;
use App\Entity\CopieExamen;
use App\Repository\CopieExamenRepositoryInterface;

final class SoumissionCopieService
{
    public function __construct(
        private readonly CalculNoteInterface $calculNote,
        private readonly CopieExamenRepositoryInterface $copieExamenRepository
    ) {
    }

    public function soumettre(SoumettreCopieDTO $dto): CopieExamen
    {
        $enRetard = $this->calculNote->estEnRetard(
            $dto->dateDepot,
            $dto->dateLimite
        );

        $noteFinale = $this->calculNote->calculerNoteFinale($dto->noteBrute, $enRetard);

        $copieExamen = new CopieExamen(
            $dto->dateDepot,
            $dto->noteBrute,
            $enRetard,
            $dto->dateLimite
        );
        $copieExamen->setNoteFinale($noteFinale);

        return $this->copieExamenRepository->save($copieExamen);
    }
}