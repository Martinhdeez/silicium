<?php

require_once "../auth/auth.php";
require_once "../config/db.php";

 
$db = new Db();

$user_id = $_SESSION['user_id'];

$notes = $db->getAllNotes($user_id); 

$selectedNote = null;
if (isset($_GET["id"])) {
    $selectedNote = $db->getNote($user_id, $_GET["id"]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $note_id = $_POST['note_id'];
    $title = $_POST['title'];
    $note = $_POST['note'];
    $data = ['title'=>$title, 'note' => $note];

    $selectedNote = $db->updateNote($user_id, $note_id, $data);
    if (!$selectedNote) {
        echo 'Error uploading note';
    }
}

require_once "../layouts/main_header.php";
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

    <h3>Hello <?= htmlspecialchars($_SESSION['username']).' with id = '. htmlspecialchars($user_id) ?></h3>
    <?php if ($selectedNote): ?>
        <form action="index.php" method ="POST">
            <input type="hidden" name="note_id" value="<?= htmlspecialchars($selectedNote['id']); ?>">
            <input type="text" name="title" value="<?= htmlspecialchars($selectedNote['title']) ?>" placeholder="Title" required>
            <textarea name="note" placeholder="Your note here..." required><?= htmlspecialchars($selectedNote['note']) ?></textarea>
            <button type="submit">Save</button>
        </form>
    <?php else: ?>
        <p>Select the note to see it</p>
    <?php endif; ?>
</div>

</body>
</html>