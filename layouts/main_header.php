<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sicilium</title>
    <link rel="stylesheet" href="../public/css/main_styles.css">
    <link rel="stylesheet" href="../public/css/profile.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<body>
    <div>
        <nav>
            <!--Logo App-->
            <a href="../views/index.php" id="silicium"><img id="logo" src="../public/img/silicio.png" alt=""><h2>licium</h2></a>
            
            <!-- User profile dropdown -->
            <div class="user-menu">
                <div class="user-icon">
                    <img src="../public/img/user-icon.webp" alt="User">
                    <div class="arrow-down"></div>
                </div>
                <div class="dropdown-content">
                    <a href="../views/profile.php">Profile</a>    
                    <a href="../controllers/id/logout.php" id="logout">Logout</a>
                </div>
            </div>
        </nav>
    </div>