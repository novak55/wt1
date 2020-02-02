<div class="container">
    <div class='row'>
        <h3 class="col-sm-6"><?=$stranka->getTitulek() ?></h3>
        <div class="col-sm-6 text-right"><a href='?akce=alba&id=<?=$stranka->getData()["kapela_id"]?>' class='btn btn-warning'>Zpět na Alba kapely</a></div>
    </div>
    <p> </p>
    <form action='?akce=alba&id=<?=$stranka->getData()["kapela_id"]?>' method='post'>
        <input type='hidden' name='id_alba' value='<?=$stranka->getData()["album_id"]?>'>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nazev_alba">Název alba*</label>
                <input type='text' name='nazev_alba' class="form-control" id="nazev_alba" placeholder="Název alba" value='<?=$data[0]["nazev_alba"]?>' required>
            </div>
            <div class="form-group col-md-3">
                <label for="rok_vydani">Rok vydání*</label>
                <input type='number' min='1900' max='<?php date('Y')?>' maxlength='4' name='rok_v' class="form-control" id="rok_vydani" placeholder="Rok vydani" value='<?=$data[0]["vydano"]?>' required>
            </div>
            <div class='col-sm-3 text-right'>
                <label for="odeslat"> </label><br>
                <button type='submit' id="odeslat" class='btn btn-success'>Odeslat album</button>
            </div>
        </div>
    </form>
</div>
