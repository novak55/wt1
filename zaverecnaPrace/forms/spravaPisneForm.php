<div class="container bg-light" style="padding: 20px;">
    <div class='row'>
        <h3 class="col-sm-9"><?= $stranka->getTitulek() ?></h3>
        <div class="col-sm-3 text-right"><a href='?akce=pisen&idAlba=<?= $stranka->getData()["album_id"]?>' class='btn btn-warning'>Zpět na Písně alba</a></div>
    </div>
    <p> </p>
    <form action='?akce=pisen&idAlba=<?= $stranka->getData()["album_id"]?>' method='post'>
        <input type='hidden' name='id_alba' value='<?= $stranka->getData()["album_id"]?>'>
        <input type='hidden' name='id_pisne' value='<?= $stranka->getData()["pisen_id"]?>'>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="poradi">Pořadí*</label>
                <input type="number" name="poradi"  min="1" maxlength="3" class="form-control" id="poradi" placeholder="pořadí" value='<?= $data[0]["poradi"]?>' required>
            </div>
            <div class="form-group col-md-5">
                <label for="nazev_pisne">Název písně*</label>
                <input type='text' name='nazev_pisne' class="form-control" id="nazev_pisne" placeholder="Název písně" value='<?= $data[0]["nazev"]?>' required>
            </div>
            <div class="form-group col-md-2">
                <label for="delka">Doba trvání*</label>
                <input type='text'  maxlength='5' name='delka' class="form-control" id="delka" placeholder="mm:ss" value='<?= $data[0]["delka"]?>' required>
            </div>
            <div class='col-sm-3 text-right'>
                <label for="odeslat"> </label><br>
                <button type='submit' id="odeslat" class='btn btn-success'>Odeslat píseň</button>
            </div>
        </div>
    </form>
</div>
