<div class="container ">
    <h3 class="col-sm-6"><?= $stranka->getTitulek() ?></h3>
    <div class='row bg-light'>
        <div class='col col-sm-2 font-weight-bolder'><a href='?podle=kapela&smer=<?= $db->getRaditOpacnySmer() ?>' title='seřadit'><em class="gly"></em>Název kapely</a></div>
    <div class='col col-sm-1 font-weight-bolder'><a href='?podle=zalozeni&smer=<?= $db->getRaditOpacnySmer() ?>' title='seřadit'>Rok založení</a></div>
    <div class='col col-sm-1 font-weight-bolder'><a href='?podle=ukonceni&smer=<?= $db->getRaditOpacnySmer() ?>' title='seřadit'>Rok ukončení</a></div>
    <div class='col col-sm-1 font-weight-bolder'><a href='?podle=zanr&smer=<?= $db->getRaditOpacnySmer() ?>' title='seřadit'>Žánr</a></div>
    <div class='col col-sm-2 font-weight-bolder'><a href='?podle=mesto&smer=<?= $db->getRaditOpacnySmer() ?>' title='seřadit'>Město</a></div>
    <div class='col col-sm-2 font-weight-bolder'><a href='?podle=stat&smer=<?= $db->getRaditOpacnySmer() ?>' title='seřadit'>Stát</a></div>
    <div class='col col-sm-3'> </div>
    </div>

<? $kapely = $db->getKapely()?>
<? if(count($kapely) > 0):?>
    <? foreach ($kapely as $row):?>
        <div class='row<? if($row['oblibena']):?> table-success' title='Tuto kapelu máte oblíbenou<?endif;?>'>
            <div class='col col-sm-2'><a href="?akce=alba&id=<?= $row["kapela_id"]?>" title="Zobrazit alba kapely"><?= $row["nazev_kapely"] ?></a></div>
            <div class='col col-sm-1'><?= $row["rok_zalozeni"] ?></div>
            <div class='col col-sm-1'><?= $row["rok_ukonceni"] ?></div>
            <div class='col col-sm-1'><?= $row["zanr_popis"] ?></div>
            <div class='col col-sm-2'><?= $row["mesto"] ?></div>
            <div class='col col-sm-2'><?= $row["stat_nazev"] ?></div>
        <? if ($security->isAuthenticated()):?>
            <div class='col col-sm-1'>
            <? if($row['oblibena']):?>
                <a class='btn btn-sm btn-outline-danger' href='?akce=odlibit&idKapely=<?= $row["kapela_id"]?>'>Znelíbit</a>
            <? else: ?>
                <a class='btn btn-sm btn-outline-success' href='?akce=oblibit&idKapely=<?= $row["kapela_id"]?>'>Oblíbit</a>
            <? endif; ?>
            </div>
        <? endif; ?>
        <? if ($security->getRole() == 'admin'):?>
            <div class="col col-sm-1">
                <a class='btn btn-sm btn-warning' href='?akce=upravitKapelu&idKapely=<?= $row["kapela_id"]?>'>upravit</a>
            </div>
            <div class="col col-sm-1">
                <a class='btn btn-sm btn-danger' href='?akce=smazatKapelu&idKapely=<?= $row["kapela_id"]?>'>smazat</a>
            </div>
        <? elseif ($security->isAuthenticated()): ?>
            <div class="col col-sm-2"> </div>
        <? else: ?>
            <div class="col col-sm-3"> </div>
        <? endif; ?>
        </div>
    <? endforeach; ?>
<? else: ?>
    <ul class='list-group'><li class='list-group-item  list-group-item-danger'>Nebyl nalezen žádný záznam.</li></ul>
<? endif; ?>
</div>