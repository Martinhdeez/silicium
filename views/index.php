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
<?php
        if ($selectedNote) {
            echo '<h2>' . htmlspecialchars($selectedNote['title']) . '</h2>';
            echo '<p>' . nl2br(htmlspecialchars($selectedNote['note'])) . '</p>';
        } else {
            echo '<p>Seleccione una nota para verla.</p>';
        }
        ?>
</div>

<script src="../public/js/newNote.js"></script>
</body>
</html>