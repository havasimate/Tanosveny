<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="../includes/read.js"></script>
<h1 id="cim" class="display-4 mb-4">Tanösvények adatai:</h1>
<div id='informaciosdiv' class="container">
    <div id='sel'>
        <label for='orszagcimke' class="form-label">Nemzeti park igazgatóság:</label>
        <select id='parkselect' class="form-select"></select>

        <label for='varoscimke' class="form-label">Város:</label>
        <select id='varosselect' class="form-select"></select>

        <label for='varoscimke' class="form-label">Tanösvény:</label>
        <select id='utselect' class="form-select"></select>

    </div>
    <div id='osvenyinfo' class="container mt-4">
        <h2 class="mb-4">Tanösvény részletei</h2>
        <div class="row">
            <div class="col-md-2 fw-bold">Név:</div>
            <div class="col-md-4" id="nev"></div>
        </div>
        <div class="row">
            <div class="col-md-2 fw-bold">Hossz:</div>
            <div class="col-md-4" id="hossz"></div>
        </div>
        <div class="row">
            <div class="col-md-2 fw-bold">Állomás:</div>
            <div class="col-md-4" id="allomas"></div>
        </div>
        <div class="row">
            <div class="col-md-2 fw-bold">Ido:</div>
            <div class="col-md-4" id="ido"></div>
        </div>
        <div class="row">
            <div class="col-md-2 fw-bold">Vezetés:</div>
            <div class="col-md-4" id="vezetes"></div>
        </div>
    </div>
</div>