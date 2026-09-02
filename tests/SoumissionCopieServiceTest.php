<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DTO\SoumettreCopieDTO;
use App\Entity\CopieExamen;
use App\Repository\CopieExamenRepositoryInterface;
use App\Service\CalculNoteAvecRetardService;
use App\Service\SoumissionCopieService;

class RepositoryEnMemoire implements CopieExamenRepositoryInterface
{
    private array $copies = [];

    public function save(CopieExamen $copie): CopieExamen
    {
        $copie->setId(count($this->copies) + 1);
        $this->copies[] = $copie;
        return $copie;
    }

    public function findAll(): array { return $this->copies; }
    public function findById(int $id): ?CopieExamen { return $this->copies[$id - 1] ?? null; }
}

$service = new SoumissionCopieService(new CalculNoteAvecRetardService(), new RepositoryEnMemoire());

$dtoATemps = SoumettreCopieDTO::fromArray([
    'note_brute' => 15,
    'date_depot' => '2026-08-30',
    'date_limite' => '2026-08-31',
]);
$copieATemps = $service->soumettre($dtoATemps);
assert($copieATemps->getNoteFinale() === 15.0);
assert($copieATemps->getId() !== null);

$dtoEnRetard = SoumettreCopieDTO::fromArray([
    'note_brute' => 15,
    'date_depot' => '2026-09-02',
    'date_limite' => '2026-08-31',
]);
$copieEnRetard = $service->soumettre($dtoEnRetard);
assert($copieEnRetard->getNoteFinale() === 13.0);

echo "Tous les tests passent." . PHP_EOL;