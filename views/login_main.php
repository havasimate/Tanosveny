<div class="row">

    <div class="col-lg-6 col-md-12">
        <h2 class="text-center py-3">Belépés</h2>
        <form action="<?= SITE_ROOT ?>admission" method="post">
            <div class="form-group mx-auto" style="max-width: 400px;">
                <label for="login" class="form-label">Felhasználónév:</label>
                <input type="text" name="login" id="login" class="form-control" required pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+">
                <br>
                <label for="password" class="form-label">Jelszó:</label>
                <input type="password" name="password" id="password" class="form-control" required pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$">
                <br>
                <input class="btn btn-dark btn-lg btn-block" type="submit" value="Bejelentkezés">
            </div>
        </form>
        <p class="err-msg text-center">
            <?= (isset($viewData['eredmeny']) && $viewData['eredmeny'] == 'ERROR') ? $viewData['uzenet'] : "" ?>
        </p>
    </div>

    <div class="col-lg-6 col-md-12">
        <h2 class="text-center py-3">Regisztráció</h2>
        <form action="<?= SITE_ROOT ?>register" method="post">
            <div class="form-group mx-auto" style="max-width: 400px;">
                <label for="csaladi_nev" class="form-label">Családi név:</label>
                <input type="text" name="csaladi_nev" id="csaladi_nev" class="form-control" required inputmode="text">
                <br>
                <label for="utonev" class="form-label">Utónév:</label>
                <input type="text" name="utonev" id="utonev" class="form-control" required inputmode="text">
                <br>
                <label for="reg_login" class="form-label">Felhasználónév:</label>
                <input type="text" name="reg_login" id="reg_login" class="form-control" required pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+">
                <br>
                <label for="reg_pw" class="form-label">Jelszó:</label>
                <input type="password" name="reg_pw" id="reg_pw" class="form-control" required pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$">
                <br>
                <label for="reg_pw_confirm" class="form-label">Jelszó megerosítése:</label>
                <input type="password" name="reg_pw_confirm" id="reg_pw_confirm" class="form-control" required pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$">
                <br>
                <input class="btn btn-dark btn-lg btn-block" type="submit" value="Regisztráció">
            </div>
        </form>
    </div>
</div>