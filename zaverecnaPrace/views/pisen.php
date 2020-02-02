<div class="container bg-light" style="padding: 20px;">
    <div class="row">
        <h3 class="col-sm-7"><?=$stranka->getTitulek() ?></h3>
        <div class="col-sm-5 text-right">
            <a href='?akce=alba&id=<?=$data[0]['kapela_id']?>' class='btn btn-warning'>Zpět na přehled alb</a>
        <?php if($security->getRole() == 'admin'):?>
            <a href='?akce=pridatPisen&idAlba=<?=$_GET["idAlba"]?>' class='btn btn-success'>Přidat píseň</a>
        <?php endif ?>
        </div>
    </div>
<p> </p>
<?php $pisne = $db->getPisneAlba($data[0]['album_id'])?>
<?php if(count($pisne) > 0):?>
    <div class='row'>
        <div class='col col-sm-1 font-weight-bolder'>Pořadí</div>
        <div class='col col-sm-6 font-weight-bolder'>Název písně</div>
        <div class='col col-sm-3 font-weight-bolder'>Doba trvání</div>
        <div class='col col-sm-2'> </div>
    </div>
    <?php foreach ($pisne as $row):?>
        <div class='row'>
            <div class='col col-sm-1 text-right'><?=$row["poradi"]?>.  </div>
            <div class='col col-sm-6'><?=$row["nazev"]?></div>
            <div class='col col-sm-3'><?=$row["delka"]?></div>
            <?php if ($security->getRole() == 'admin'):?>
                <div class="col col-sm-1">
                    <a class='btn btn-sm btn-warning' href='?akce=upravitPisen&idPisne=<?=$row["pisen_id"]?>'>upravit</a>
                </div>
                <div class="col col-sm-1">
                    <a class='btn btn-sm btn-danger' href='?akce=smazatPisen&idPisne=<?=$row["pisen_id"]?>&idAlba=<?=$_GET['idAlba']?>'>smazat</a>
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