<?php $erreurs = $erreurs ?? []; ?>

<div class="alert" role="alert">
    <strong>Des erreurs empêchent l'enregistrement :</strong>
    <ul>
        <?php foreach ($erreurs as $erreur): ?>
            <li><?= htmlspecialchars($erreur) ?></li>
        <?php endforeach; ?>
    </ul>
</div>