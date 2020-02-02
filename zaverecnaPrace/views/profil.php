<div class="container bg-light" style="padding: 20px;">
    <div class="row">
        <h3 class="col-sm-6"><?=$stranka->getTitulek()?></h3>
    </div>
    <p> </p>
    <div class='row'>
        <div class='col col-sm-6 font-weight-bolder'>Vaše jméno</div>
        <div class='col col-sm-6'><?=$security->getUserName()?></div>
    </div>
    <div class="row">
        <div class='col col-sm-6 font-weight-bolder'>Váš login</div>
        <div class='col col-sm-6'><?=$security->getUserLogin()?></div>
    </div>
    <div class="row">
        <div class='col col-sm-6 font-weight-bolder'>Přiřazebá role</div>
        <div class='col col-sm-6'><?=$security->getRole()?></div>
    </div>
</div>