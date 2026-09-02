<?php

namespace App\Service;

use App\DTO\SoumettreCopieDTO;
use App\Entity\CopieExamen;
use App\Repository\CopieExamenRepositoryInterface;

class SoumissionCopieService
{
    public function __construct(
        private CalculNoteInterface $calculNote,
        private CopieExamenRepositoryInterface $repository
    ) {
    }

    public function soumettre(SoumettreCopieDTO $dto): CopieExamen
    {
        $penaliteAppliquee = $dto->dateDepot > $dto->dateLimite;

        $noteFinale = $this->calculNote->calculer($dto->noteBrute, $penaliteAppliquee);

        $copie = new CopieExamen(
            dateDepot: $dto->dateDepot->format('Y-m-d'),
            noteBrute: $dto->noteBrute,
            penaliteAppliquee: $penaliteAppliquee,
            dateLimite: $dto->dateLimite->format('Y-m-d')
        );

        $copie->setNoteFinale($noteFinale);

        return $this->repository->save($copie);
    }
}