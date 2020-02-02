<div class="container bg-light" style="padding: 20px;">
    <div class='row'>
        <h3 class="col-sm-6">Správa kapely</h3>
        <div class="col-sm-6 text-right"><a href='?' class='btn btn-warning'>Zpět na přehled kapel</a></div>
    </div>
    <p> </p>
    <form action='index.php' method='post'>
        <input type='hidden' name='id' value='<?= $data[0]["kapela_id"]?>'>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nazev_kapely">Náazev kapely*</label>
                <input type='text' name='nazev_kapely' class="form-control" id="nazev_kapely" placeholder="Název kapely" value='<?= $data[0]["nazev_kapely"]?>' required>
            </div>
            <div class="form-group col-md-3">
                <label for="rok_zalozeni">Rok založení*</label>
                <input type='number' min='1900' max='2020' maxlength='4' name='rok_z' class="form-control" id="rok_zalozeni" placeholder="Rok založení" value='<?= $data[0]["rok_zalozeni"]?>' required>
            </div>
            <div class="form-group col-md-3">
                <label for="inputPassword4">Rok ukončení</label>
                <input type='number' min='1900' max='2020' maxlength='4' name='rok_u' class="form-control" id="rok_ukonceni" placeholder="Rok ukončení" value='<?= $data[0]["rok_ukonceni"]?>'>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="mesto">Město</label>
                <input type='text' name='mesto' class="form-control" id="mesto" placeholder="Město" value='<?= $data[0]["mesto"]?>'>
            </div>
            <div class="form-group col-md-4">
                <label for="stat">Zvolte stát</label>
                    <select id="stat" class="form-control" name='stat' required><option></option>";
                        <? foreach ($db->getStaty() as $stat):?>
                            $stranka .= "<option value='<?= $stat["stat_id"]?>' <? if($data[0]['stat_id'] === $stat['stat_id']):?>selected<? endif;?>><?= $stat["nazev"]?></option>";
                        <? endforeach; ?>
                    </select>
            </div>
            <div class="form-group col-md-3">
                <label for="zanr">Zvolte žánr</label>
                <select name='zanr' class="form-control" name='zanr' required><option></option>";
                    <? foreach ($db->getZanr() as $zanr):?>
                        <option  value='<?= $zanr["zanr_id"]?>' <? if($data[0]['zanr_id'] === $zanr['zanr_id']):?>selected<? endif ?>><?= $zanr["popis"]?></option>
                    <? endforeach; ?>
                </select>
            </div>
        </div>
        <P> </P>
        <div class='row text-center'>
            <div class='col-sm-12'>
                <button type='submit' class='btn btn-success'>Odeslat kapelu</button>
            </div>
        </div>
    </form>
</div>
