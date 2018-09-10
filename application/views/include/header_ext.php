<header>
    <div class="row">
        <div class="col-3">
            <a href="<?= base_url() ?>">
                <img src="<?= base_url('assets/img/misc/logo.png') ?>" alt="Logo Gifty" id="logo"></a>
        </div>
        <form method="post" action="<?= base_url('gifty/logar') ?>">
            <div class="col-4">
                <label for="user" hidden><i class="fas fa-user"></i></label>
                <input type="text" id="user" name="user"
                       placeholder="Nome de Usuário ou E-mail">
                
            </div>
            <div class="col-3">
                <label for="senha" hidden><i class="fas fa-lock"></i></label>
                <input type="password" id="senha" name="senha"
                       placeholder="Senha">      
            </div>
            <div class="col-2">
                <input type="submit" value="Entrar" id="btEntrar">
            </div>
            <div class="col-3">
            </div>
            <div class="col-4">
                <small>Ainda não é membro? <a href="<?= base_url('gifty/cadastrar') ?>">Cadastre-se!</a></small>
            </div>
            <div class="col-5">
                <small><a href="<?= base_url('gifty/esqueci_senha') ?>">Esqueceu a senha?</a></small>
            </div>
        </form>
    </div>
</header>
