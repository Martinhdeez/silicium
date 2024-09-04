<?php

require_once "../auth/auth.php";
require_once "../config/db.php";


$db = new Db();

$user_id = $_SESSION['user_id'];


//Create
if (isset($_POST['create'])) {
    $title = 'Untitled';
    $note = '';
    $data = ['title' => $title, 'note' => $note];

    $newNote = $db->createNote($user_id, $data);

}

//Read
$notes = $db->getAllNotes($user_id);

$selectedNote = null;
if (isset($_GET["id"])) {
    $selectedNote = $db->getNote($user_id, $_GET["id"]);
}

//Update
if (isset($_POST["update"])) {

    $note_id = $_POST['note_id'];
    $title = $_POST['title'];
    $note = $_POST['note'];
    $data = ['title' => $title, 'note' => $note];

    $selectedNote = $db->updateNote($user_id, $note_id, $data);

    if (!$selectedNote) {
        echo 'Error uploading note';
    }

}

//Delete
if (isset($_POST["delete"])) {
    $note_id = $_POST['note_id'];

    $isDeleted = $db->deleteNote($user_id, $note_id);

    if (!$isDeleted) {
        echo 'Error deleting note';
    }
}

require_once "../layouts/main_header.php";
?>
<div class="container">
    <!--BARRA LATERAL-->
    <aside class="sidebar">
        <form action="index.php" method="POST" class="new-note-form">
            <!--Logo de un '+' con tooltip de "New Note"-->
            <button type="submit" name="create" class="new-note-button" title="New Note">+</button>
        </form>
        <?php
        if ($notes) {
            foreach ($notes as $note) {
                echo '<div class="note-item">';
                echo '<a href="?id=' . htmlspecialchars($note['id']) . '" class="note-link">' . htmlspecialchars($note['title']) . '</a>';
                echo '</div>';
            }
        } else {
            echo '<p class="no-notes">No se encontraron notas.</p>';
        }
        ?>
    </aside>
    <!--CONTENIDO PRINCIPAL-->
    <div class="main-content">
        

        <?php if ($selectedNote): ?>
            <form action="index.php" method="POST" class="note-form">
                <input type="hidden" name="note_id" value="<?= htmlspecialchars($selectedNote['id']); ?>">
                <input type="text" name="title" value="<?= htmlspecialchars($selectedNote['title']) ?>" placeholder="Title"
                    class="note-title-input" required>
                <textarea name="note" placeholder="Your note here..."
                    class="note-textarea"><?= htmlspecialchars($selectedNote['note']) ?></textarea>
                <button type="submit" name="update" class="save-button">Save</button>
            </form>
            <form action="index.php" method="POST" class="delete-form">
                <input type="hidden" name="note_id" value="<?= htmlspecialchars($selectedNote['id']); ?>">
                <button type="submit" name="delete" class="delete-button">Delete this note</button>
            </form>
        <?php else: ?>
            <p class="no-note-selected">Select the note to see it</p>
        <?php endif; ?>
    </div>
</div>

</html>