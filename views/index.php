<?php
require_once "../layouts/main_header.php";
require_once "../auth/auth.php";
require_once "../includes/api_functions.php";
 

$notes = getNotes(); 

$selectedNote = null;
if (isset($_GET["id"])) {
    $selectedNote = getNote($_GET["id"]);
}
?>

<!--BARRA LATERAL-->
<aside>
    <button id="createNoteBtn">New Note</button>
     <?php
        if ($notes) {
            foreach ($notes as $note) {
                echo '<div>';
                echo '<a href="?id=' . htmlspecialchars($note['id']) . '">' . htmlspecialchars($note['title']) . '</a>';
                echo '</div>';
            }
        } else {
            echo '<p>No se encontraron notas.</p>';
        }
        ?> 
</aside>
<!--CONTENIDO PRINCIPAL-->
<div>
    <h1>Silicium</h1>
    <h3>Hello <?= htmlspecialchars($_SESSION['username']).' with id = '. htmlspecialchars($_SESSION['user_id']) ?></h3>
    <?php if ($selectedNote): ?>
        <form id="NoteForm">
            <input type="hidden" name="id" value="<?= htmlspecialchars($selectedNote['id']) ?>">
            <input type="text" name="title" value="<?= htmlspecialchars($selectedNote['title']) ?>" placeholder="Title" required>
            <textarea name="note" placeholder="Your note here..." required><?= htmlspecialchars($selectedNote['note']) ?></textarea>
            <button type="submit">Save</button>
        </form>
    <?php else: ?>
        <p>Seleccione una nota para verla.</p>
    <?php endif; ?>
</div>

<script src="../public/js/newNote.js"></script>
scri
</body>
</html>