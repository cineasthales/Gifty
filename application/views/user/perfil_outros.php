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
            <div class="col-8">
                <br><br><button class="btBloq"><a href="<?= base_url('usuario/amigos') ?>">
                        <i class="fas fa-user-plus"></i> Solicitar Amizade</a></button>
            </div>
        </div>
    </section>    
</main>