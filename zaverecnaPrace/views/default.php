<div class="container ">
    <h3 class="col-sm-6"><?=$stranka->getTitulek()?></h3>
    <p> </p>
    <div class='row'>
        <div class='col col-sm-2 font-weight-bolder'><a href='?podle=kapela&smer=<?=$db->getRaditOpacnySmer()?>' title='seřadit'><em class="gly"></em>Název kapely</a></div>
        <div class='col col-sm-1 font-weight-bolder'><a href='?podle=zalozeni&smer=<?=$db->getRaditOpacnySmer()?>' title='seřadit'>Rok založení</a></div>
        <div class='col col-sm-1 font-weight-bolder'><a href='?podle=ukonceni&smer=<?=$db->getRaditOpacnySmer()?>' title='seřadit'>Rok ukončení</a></div>
        <div class='col col-sm-1 font-weight-bolder'><a href='?podle=zanr&smer=<?=$db->getRaditOpacnySmer()?>' title='seřadit'>Žánr</a></div>
        <div class='col col-sm-2 font-weight-bolder'><a href='?podle=mesto&smer=<?=$db->getRaditOpacnySmer()?>' title='seřadit'>Město</a></div>
        <div class='col col-sm-2 font-weight-bolder'><a href='?podle=stat&smer=<?=$db->getRaditOpacnySmer()?>' title='seřadit'>Stát</a></div>
        <div class='col col-sm-3'> </div>
    </div>

<?php $kapely = $db->getKapely()?>
<?php if(count($kapely) > 0):?>
    <?php foreach ($kapely as $row):?>
        <div class='row<?php if($row['oblibena']):?> table-success' title='Tuto kapelu máte oblíbenou<?php endif;?>'>
            <div class='col col-sm-2'><a href="?akce=alba&id=<?=$row["kapela_id"]?>" title="Zobrazit alba kapely"><?=$row["nazev_kapely"]?></a></div>
            <div class='col col-sm-1'><?=$row["rok_zalozeni"]?></div>
            <div class='col col-sm-1'><?=$row["rok_ukonceni"]?></div>
            <div class='col col-sm-1'><?=$row["zanr_popis"]?></div>
            <div class='col col-sm-2'><?=$row["mesto"]?></div>
            <div class='col col-sm-2'><?=$row["stat_nazev"]?></div>
        <?php if ($security->isAuthenticated()):?>
            <div class='col col-sm-1'>
            <?php if($row['oblibena']):?>
                <a class='btn btn-sm btn-outline-danger' href='?akce=odlibit&idKapely=<?=$row["kapela_id"]?>'>Znelíbit</a>
            <?php else: ?>
                <a class='btn btn-sm btn-outline-success' href='?akce=oblibit&idKapely=<?=$row["kapela_id"]?>'>Oblíbit</a>
            <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if ($security->getRole() == 'admin'):?>
            <div class="col col-sm-1">
                <a class='btn btn-sm btn-warning' href='?akce=upravitKapelu&idKapely=<?=$row["kapela_id"]?>'>upravit</a>
            </div>
            <div class="col col-sm-1">
                <a class='btn btn-sm btn-danger' href='?akce=smazatKapelu&idKapely=<?=$row["kapela_id"]?>'>smazat</a>
            </div>
        <?php elseif ($security->isAuthenticated()):?>
            <div class="col col-sm-2"> </div>
        <?php else:?>
            <div class="col col-sm-3"> </div>
        <?php endif;?>
        </div>
    <?php endforeach;?>
<?php else:?>
    <ul class='list-group'><li class='list-group-item  list-group-item-danger'>Nebyl nalezen žádný záznam.</li></ul>
<?php endif;?>
</div>