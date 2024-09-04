<?php

require_once "../auth/auth.php";
require_once "../config/db.php";

 
$db = new Db();

$user_id = $_SESSION['user_id'];


//Create
if(isset($_POST['create'])) {
    $title = 'Untitled';
    $note = '';
    $data = ['title'=>$title, 'note'=> $note];

    $newNote =$db->createNote($user_id,$data);

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
    $data = ['title'=>$title, 'note' => $note];

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

<!--BARRA LATERAL-->
<aside>
    <form action="index.php"method ="POST" >
        <!--Esto quiero que sea el logo de un '+' y si pones el raton encima, ponga New Note-->
        <button type="submit" name="create">New Note</button>
    </form>
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
            <textarea name="note" placeholder="Your note here..."><?= htmlspecialchars($selectedNote['note']) ?></textarea>
            <button type="submit" name="update">Save</button>
        </form>
        <form action="index.php" method="POST">
            <input type="hidden" name="note_id" value="<?= htmlspecialchars($selectedNote['id']); ?>">
            <button type="submit" name="delete">Delete this note</button>
        </form>
    <?php else: ?>
        <p>Select the note to see it</p>
    <?php endif; ?>
</div>

</body>
</html>