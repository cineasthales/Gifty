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
                    <h1>Gifty <span id="gift">d</span></h1>
                </div>
                <form method="post" action="<?= base_url('home/logar') ?>">
                    <div class="grid-4">
                        <br>
                        <label for="user" hidden><i class="fas fa-user"></i></label>
                        <input type="text" id="user" name="user"
                               placeholder="Nome de Usuário ou E-mail">
                    </div>
                    <div class="grid-3">
                        <br>
                        <label for="senha" hidden><i class="fas fa-lock"></i></label>
                        <input type="password" id="senha" name="senha"
                               placeholder="Senha">
                    </div>
                    <div class="grid-2">
                        <br>
                        <input type="submit" value="Entrar" id="btEntrar">
                    </div>
                </form>
                <div class="grid-3">
                    <br>
                    <small><a href="#">Esqueci a senha</a></small>
                </div>
            </div>
        </div>
    </header>