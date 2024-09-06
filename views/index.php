
<?php

require_once "../auth/auth.php";
require_once "../includes/api_functions.php";
require_once "../includes/functions.php";

$user_id = $_SESSION['user_id'];

$baseURL="http://localhost/silicium/api/notes.php/$user_id";

//Create
if (isset($_POST['create'])) {

    $title = 'Untitled';
    $note = '';
    $data = ['title' => $title, 'note' => $note];

    $newNote = createNote($baseURL, $data);
    if (!$newNote) {
        $_SESSION['error']= 'Error creating new note';
    }else{
        $_SESSION['success'] = 'Note created successfully';
    }
}

//Read
$notes = getNotes($baseURL);

$selectedNote = null;
if (isset($_GET["id"])) {
    $note_id = $_GET['id'];
    $selectedNote = getNote($baseURL, $note_id);
}

//Update
if (isset($_POST["update"])) {

    $note_id = $_POST['note_id'];
    $title = $_POST['title'];
    $note = $_POST['note'];
    $data = ['title' => $title, 'note' => $note];

    $selectedNote = updateNote($baseURL, $note_id, $data);

    if (!$selectedNote) {
        $_SESSION['error']= 'Error updating note';
    }else{
        $_SESSION['success'] = 'Note updated successfully';

        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $note_id);
        exit();
    }
}


//Delete
if (isset($_POST["delete"])) {
    $note_id = $_POST['note_id'];

    $isDeleted = deleteNote($baseURL, $note_id);

    if (!$isDeleted) {
        $_SESSION['error']= 'Error deleting note';
    }else{
        $_SESSION['success'] = 'Note deleted successfully';

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

require_once "../layouts/main_header.php";
?>

<div class="container">
    <!--BARRA LATERAL-->
    <aside class="sidebar" id="aside">
        <form action="index.php" method="POST" class="new-note-form">
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
            echo '<p class="no-notes">Notes do not</p>';
        }
        ?>
    </aside>
 
    <!--CONTENIDO PRINCIPAL-->
    <div class="main-content">
    <div id="menu-btn" style="cursor: pointer;">
        <i class="fas fa-bars" id="bar" style="color: white; margin-left: -40px; cursor: pointer;"></i>
    </div>
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
            <div class="success-message">
                <?= htmlspecialchars("Hello " .$_SESSION['username']. "!"); ?>
            </div>
            <?php success(); ?>
            <p class="no-note-selected">Select the note to see it</p>
        <?php endif; ?>
    </div>
</div>
<script>

document.getElementById('menu-btn').addEventListener('click', function() {
    var aside = document.getElementById('aside');
    
    if (aside) {
        if (aside.classList.contains('hidden')) {
            aside.classList.remove('hidden'); 
            aside.style.display = 'flex'; 
            console.log('Aside is now visible');
        } else {
            aside.classList.add('hidden');
            aside.style.display = 'none';
            console.log('Aside is now hidden');
        }
    } else {
        console.log('Aside element not found');
    }
});


</script>
</body>
</html>