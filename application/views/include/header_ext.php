<header>
    <div class="row">
        <div class="col-3">
            <a href="<?= base_url() ?>">
                <img src="<?= base_url('assets/img/misc/logo.png') ?>" alt="Logo Gifty" id="logo"></a>
        </div>
        <form method="post" action="<?= base_url('home/logar') ?>">
            <div class="col-4">
                <label for="user" hidden><i class="fas fa-user"></i></label>
                <input type="text" id="user" name="user"
                       placeholder="Nome de Usuário ou E-mail">
            </div>
            <div class="col-3">
                <label for="senha" hidden><i class="fas fa-lock"></i></label>
                <input type="password" id="senha" name="senha"
                       placeholder="Senha">
                <br>
                <small><a href="#">Esqueci a senha</a></small>
            </div>
            <div class="col-2">
                <input type="submit" value="Entrar" id="btEntrar">
            </div>
        </form>
    </div>
</header>
