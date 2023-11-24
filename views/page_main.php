<!DOCTYPE html>
<html lang="hu-hu">

<head>
    <meta charset="utf-8">
    <title>Tanösvények</title>
    <link rel="icon" type="image/x-icon" href="./images/mountain.png">
    <!-- Bootstrap stíluslapok -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- Jquery, Popper.js és Bootstrap JavaScript fájlok -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- A saját stíluslapok és JavaScript fájlok -->
    <script type="text/javascript" src="<?php echo SITE_ROOT ?>/js/form_validator.js"></script>

    <?php // if ($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="' . $viewData['style'] . '">'; 
    ?>
</head>

<body class="bg-light">
    <div class="container-fluid p-0 min-vh-100 d-flex flex-column">
        <header>
            <div class="bg-primary text-white text-center py-3">
                <p>
                    <?= ($_SESSION['userid'] != 0 && isset($_SESSION['userid'])) ? "Bejelentkezve: " . $_SESSION['userlastname'] . " " . $_SESSION['userfirstname'] . " (" . $_SESSION['username'] . ")." : "" ?>
                    <?= ($_SESSION['userlevel'] == '__1') ? " ADMIN" : "" ?>
                </p>
                <?= Menu::renderNavbar($viewData['selectedItems']); ?>
            </div>
        </header>
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <section>
                        <?php if ($viewData['render']) include($viewData['render']); ?>
                    </section>
                </div>
            </div>
        </div>

        <div class="bg-primary text-white text-center py-3 mt-auto">
            <footer id="lab">
                &copy; Copyright <?= date("Y") ?>. Carlito Travel Agency Kft.
            </footer>
        </div>
    </div>
</body>

</html>