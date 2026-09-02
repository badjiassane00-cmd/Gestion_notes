<div style="border: 1px solid red; padding: 10px; margin-bottom: 20px;">
    <strong>Des erreurs empêchent l'enregistrement :</strong>
    <ul>
        <?php foreach ($erreurs as $erreur): ?>
            <li><?= htmlspecialchars($erreur) ?></li>
        <?php endforeach; ?>
    </ul>
</div>