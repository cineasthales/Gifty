<header>
    <div class="row">
        <div class="col-4">
            <a href="<?= base_url() ?>">
                <img src="<?= base_url('assets/img/misc/logo.png') ?>" alt="Logo Gifty" id="logo"></a>
        </div>
        <div class="col-8">
            <nav>
                <ul>
                    <li><a href="<?= base_url('usuario/inicio') ?>"><i class="fas fa-home"></i> Início</a></li>
                    <li><a href="<?= base_url('usuario/listas') ?>"><i class="fas fa-gift"></i> Listas</a></li>
                    <li><a href="<?= base_url('usuario/amigos') ?>"><i class="fas fa-users"></i> Amigos</a></li>  
                    <li><a href="<?= base_url('usuario/configuracoes') ?>"><i class="fas fa-cog"></i> Configurações</a></li>
                    <li><a href="<?= base_url('gifty/sair') ?>"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>