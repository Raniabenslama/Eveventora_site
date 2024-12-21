<form method="POST" action="add_participant_action.php">
    <input type="hidden" name="event_id" value="<?= $_GET['event_id'] ?>">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>
    <label for="telephone">Téléphone :</label>
    <input type="text" id="telephone" name="telephone">
    <button type="submit">Ajouter</button>
</form>
