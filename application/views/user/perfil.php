<main>
    <section>
        <div class="row"> 
            <div class="col-6">
                <h1>Perfil</h1>
            </div>            
            <div class="col-12">
                <br>
            </div>
            <div class="col-4">
                <img style="width: 100%;" src="<?= base_url('assets/img/profiles/' . $usuario->imagem) ?>"   
                     alt="Foto de perfil de <?= $usuario->nome ?> <?= $usuario->sobrenome ?>">
            </div>
            <div class="col-8">
                <h2><?= $usuario->nome ?> <?= $usuario->sobrenome ?></h2><br>
            </div>
            <div class="col-2">
                <strong>Idade</strong>
            </div>
            <div class="col-6">
                <?= floor(date('Y') - date_format(date_create($usuario->dataNasc), 'Y')) ?> anos
            </div>
            <div class="col-2">
                <strong>Aniversário</strong>
            </div>            
            <div class="col-6">
                <?= date_format(date_create($usuario->dataNasc), 'd/m') ?>
            </div>
            <div class="col-2">
                <strong>Gênero</strong>
            </div>
            <div class="col-6">
                <?= $usuario->genero ?>
            </div>
            <div class="col-2">
                <strong>Cidade</strong>
            </div>
            <div class="col-6">
                <?= $usuario->cidade ?> / <?= $usuario->estado ?> 
            </div>
            <div class="col-2">
                <strong>Nome de Usuário</strong>
            </div>
            <div class="col-6">
                <?= $usuario->nomeUsuario ?>
            </div>
            <div class="col-2">
                <strong>E-mail</strong>
            </div>
            <div class="col-6">
                <?= $usuario->email ?>
            </div>
            <div class="col-8">
                <?php
                $difA = floor(date('Y') - date_format(date_create($amizade->data), 'Y'));
                if ($difA == 0) {
                    $difM = abs(floor(date('m') - date_format(date_create($amizade->data), 'm')));
                    if ($difM == 0) {
                        ?>
                        <br><br><strong>Vocês são amigos há menos de 1 mês</strong>
                    <?php } else if ($difM == 1) { ?>
                        <br><br><strong>Vocês são amigos há 1 mês</strong>
                    <?php } else { ?>
                        <br><br><strong>Vocês são amigos há <?= $difM ?> meses</strong>
                    <?php } ?>                    
                <?php } else if ($difA == 1) { ?>
                    <br><br><strong>Vocês são amigos há 1 ano</strong>
                <?php } else { ?>       
                    <br><br><strong>Vocês são amigos há <?= $difA ?> anos</strong>
                <?php } ?>                
            </div>
            <div class="col-8">
                <br><br><button class="btBloq"><a href="<?= base_url('usuario/amigos') ?>" onclick="return confirm('Tem certeza que deseja bloquear <?= $usuario->nome ?> <?= $usuario->sobrenome ?>?')">
                        <i class="fas fa-user-slash"></i> Bloquear Amigo</a></button>      
                <button class="btExc"><a href="<?= base_url('usuario/amigos') ?>" onclick="return confirm('Tem certeza que deseja excluir <?= $usuario->nome ?> <?= $usuario->sobrenome ?>?')">
                        <i class="fas fa-user-times"></i> Excluir Amigo</a></button>
            </div>
        </div>
    </section>    
</main>