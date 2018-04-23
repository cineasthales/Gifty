<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Gifty</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/reset.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/grid.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/desktop.css') ?>">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>    
        <header>
            <div class="container">
                <div class="grid-4">
                    <h1><a href="<?= base_url() ?>">
                            <img src="<?= base_url('assets/img/misc/logo.png') ?>" alt="Logo Gifty"></a></h1>
                </div>
                <nav>
                    <div class="grid-12">
                        <br>
                        <ul>
                            <li><a href="<?= base_url('home/sair') ?>"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                            <li><a href="<?= base_url('configuracoes') ?>"><i class="fas fa-cog"></i> Configurações</a></li>
                            <li><a href="<?= base_url('perfil') ?>"><i class="fas fa-user"></i> Perfil</a></li>
                            <li><a href="<?= base_url('amigos') ?>"><i class="fas fa-users"></i> Amigos</a></li>                            
                            <li><a href="<?= base_url('listas') ?>"><i class="fas fa-list-ul"></i> Listas</a></li>
                            <li><a href="<?= base_url('dashboard') ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>