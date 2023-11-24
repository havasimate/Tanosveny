<h2 class="centered-title">PDF generálása inputok alapján</h2>
<form name="tour_filter_form" onsubmit="return validateForm();" action="<?= SITE_ROOT ?>pdfquery" method="post">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <fieldset class="framed-fieldset">
                <legend>Túra hossza</legend>
                <label for="min_dist" class="form-label">Min:</label>
                <input type="number" id="min_dist" name="min_dist" min="0" max="50" class="form-control" />
                <br>
                <label for="max_dist" class="form-label">Max:</label>
                <input type="number" id="max_dist" name="max_dist" min="0" max="50" class="form-control">
            </fieldset>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <fieldset class="framed-fieldset">
                <legend>Túra idotartama</legend>
                <label for="min_time" class="form-label">Min:</label>
                <input type="number" id="min_time" name="min_time" min="0" max="50" class="form-control" />
                <br>
                <label for="max_time" class="form-label">Max:</label>
                <input type="number" id="max_time" name="max_time" min="0" max="50" class="form-control">
            </fieldset>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <fieldset class="framed-fieldset">
                <legend>Túravezetovel</legend>
                <label for="with_guide" class="form-label">Túravezetovel:</label>
                <br>
                <select name="with_guide" id="with_guide" class="form-select">
                    <option value="either" selected>Mindegy</option>
                    <option value="guide_yes">Igen</option>
                    <option value="guide_no">Nem</option>
                </select>
            </fieldset>
        </div>
    </div>
    <button id="sendform" class="btn btn-primary btn-lg btn-block" type="submit">
        PDF generálása
    </button>
</form>