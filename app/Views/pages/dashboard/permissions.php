<div class="separator mb-4" data-aos="fade-right">

    <strong>DADOS DA SESSÃO</strong>
    <hr>

    user_id: <?= userId() ?> <br>

    user_name: <?= userName() ?> <br>

    user_email: <?= userEmail() ?> <br>

    user_role: <?= userRole() ?> <br>

    isAdmin: <?= isAdmin() ? 'Sim' : 'Não' ?> <br>

    <br>

    <strong>PERMISSÕES</strong>

    <hr>

    dashboard.view:
    <?= can('dashboard.view') ? 'Sim' : 'Não' ?>
    <br>

    patients.view:
    <?= can('patients.view') ? 'Sim' : 'Não' ?>
    <br>

    patients.create:
    <?= can('patients.create') ? 'Sim' : 'Não' ?>
    <br>

    patients.update:
    <?= can('patients.update') ? 'Sim' : 'Não' ?>
    <br>

    patients.hospitalize:
    <?= can('patients.hospitalize') ? 'Sim' : 'Não' ?>
    <br>

    patients.finalize:
    <?= can('patients.finalize') ? 'Sim' : 'Não' ?>
    <br>

    patients.pdf:
    <?= can('patients.pdf') ? 'Sim' : 'Não' ?>
    <br>

    patients.observation:
    <?= can('patients.observation') ? 'Sim' : 'Não' ?>
    <br>

    <hr>

    triage.view:
    <?= can('triage.view') ? 'Sim' : 'Não' ?>
    <br>

    triage.create:
    <?= can('triage.create') ? 'Sim' : 'Não' ?>
    <br>

    triage.update:
    <?= can('triage.update') ? 'Sim' : 'Não' ?>
    <br>

    <hr>

    hospitalization.view:
    <?= can('hospitalization.view') ? 'Sim' : 'Não' ?>
    <br>

    <hr>

    requests.view:
    <?= can('requests.view') ? 'Sim' : 'Não' ?>
    <br>

    requests.create:
    <?= can('requests.create') ? 'Sim' : 'Não' ?>
    <br>

    requests.update:
    <?= can('requests.update') ? 'Sim' : 'Não' ?>
    <br>

    requests.delete:
    <?= can('requests.delete') ? 'Sim' : 'Não' ?>
    <br>

    <hr>

    users.view:
    <?= can('users.view') ? 'Sim' : 'Não' ?>
    <br>

    users.create:
    <?= can('users.create') ? 'Sim' : 'Não' ?>
    <br>

    users.update:
    <?= can('users.update') ? 'Sim' : 'Não' ?>
    <br>

    users.delete:
    <?= can('users.delete') ? 'Sim' : 'Não' ?>
    <br>

</div>