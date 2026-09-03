<?php

namespace App\Controller;

use App\DTO\SoumettreCopieDTO;
use App\Repository\CopieExamenRepositoryInterface;
use App\Service\SoumissionCopieService;
use InvalidArgumentException;

class CopieExamenController
{
    public function __construct(
        private SoumissionCopieService $service,
        private CopieExamenRepositoryInterface $repository
    ) {
    }

    public function afficherFormulaire(array $erreurs = []): void
    {
        require dirname(__DIR__, 2) . '/templates/copie_form.php';
    }

    public function soumettre(array $post): void
    {
        try {
            $dto = SoumettreCopieDTO::fromArray($post);
            $copie = $this->service->soumettre($dto);

            header('Location: /copies/' . $copie->getId());
            exit;
        } catch (InvalidArgumentException $e) {
            $erreurs = [$e->getMessage()];
            $this->afficherFormulaire($erreurs);
        }
    }

    public function afficherListe(): void
    {
        $copies = $this->repository->findAll();

        require dirname(__DIR__, 2) . '/templates/copie_liste.php';
    }

    public function afficherDetail(int $id): void
    {
        $copie = $this->repository->findById($id);

        if ($copie === null) {
            http_response_code(404);
            $erreurs = ["Aucune copie trouvée avec l'identifiant {$id}."];
            require dirname(__DIR__, 2) . '/templates/erreur.php';
            return;
        }

        require dirname(__DIR__, 2) . '/templates/copie_detail.php';
    }
}
