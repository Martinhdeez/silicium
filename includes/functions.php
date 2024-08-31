<?php
function success() {
    
    if (isset($_SESSION['success'])) {
        echo "<p class='success'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo "<p class='error'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }

}