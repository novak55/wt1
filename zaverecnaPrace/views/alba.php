<div class="container">
    <div class="row">
        <h3 class="col-sm-6"><?=$stranka->getTitulek()?></h3>
        <div class="col-sm-6 text-right">
            <a href='?' class='btn btn-warning'>Zpět na přehled kapel</a>
            <?php if($security->getRole() == 'admin'):?>
            <a href='?akce=pridatAlbum&idKapely=<?=$_GET["id"]?>' class='btn btn-success'>Přidat album</a>
            <?php endif ?>
        </div>
    </div>
<p> </p>
<?php $alba = $db->getAlbaKapely($_GET['id'])?>
<?php if(count($alba) > 0):?>
    <div class='row'>
        <div class='col col-sm-7 font-weight-bolder'>Název alba</div>
        <div class='col col-sm-3 font-weight-bolder'>Rok vydání</div>
        <div class='col col-sm-2'> </div>
    </div>
    <?php foreach ($alba as $row):?>
        <div class='row'>
            <div class='col col-sm-7'><a href="?akce=pisen&idAlba=<?= $row["album_id"]?>"><?= $row["nazev_alba"] ?></a></div>
            <div class='col col-sm-3'><?= $row["vydano"] ?></div>
            <?php if ($security->getRole() == 'admin'):?>
                <div class="col col-sm-1">
                    <a class='btn btn-sm btn-warning' href='?akce=upravitAlbum&idAlba=<?= $row["album_id"]?>'>upravit</a>
                </div>
                <div class="col col-sm-1">
                    <a class='btn btn-sm btn-danger' href='?akce=smazatAlbum&idAlba=<?= $row["album_id"]?>&idKapely=<?= $row['kapela_id']?>'>smazat</a>
                </div>
            <?php else: ?>
                <div class="col col-sm-2">
                     
                </div>
            <?php endif;?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <ul class='list-group'><li class='list-group-item  list-group-item-danger'>Nebyl nalezen žádný záznam.</li></ul>
<?php endif; ?>
</div>