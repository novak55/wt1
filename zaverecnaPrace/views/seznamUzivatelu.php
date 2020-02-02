<div class="container bg-light" style="padding: 20px;">
    <div class="row">
        <h3 class="col-sm-6"><?= $stranka->getTitulek() ?></h3>
    </div>
    <p> </p>
    <div class="row">
        <div class="col col-lg-4 font-weight-bolder">Login</div>
        <div class="col col-lg-4 font-weight-bolder">Role</div>
        <div class="col col-lg-4 font-weight-bolder">Jméno</div>
    </div>
    <? foreach ($db->getUsers() as $user):?>
    <div class='row'>
        <div class='col col-sm-4'><?= $user['login'] ?></div>
        <div class='col col-sm-4'><?= $user['role_id'] ?></div>
        <div class='col col-sm-4'><?= $user['user_name'] ?></div>
    </div>
    <? endforeach; ?>
</div>