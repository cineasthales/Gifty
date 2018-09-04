<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Configurações</h1>
            </div>
            <div class="col-12">
                <h2>Seu Perfil</h2>
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
            <div class="col-8">
                <br>
            </div>
            <div class="col-2">
                <strong>E-mail</strong>
            </div>
            <div class="col-6">
                <?= $usuario->email ?>
            </div>
            <?php if (count($telefones) > 0) { ?>
                <?php if (count($telefones) == 1) { ?>
                    <div class="col-2">
                        <strong>Telefone</strong>
                    </div>
                <?php } else { ?>
                    <div class="col-2">
                        <strong>Telefones</strong>
                    </div>
                <?php } ?>
                <div class="col-6">
                    <?php foreach ($telefones as $telefone) { ?>
                        (<?= $telefone->ddd ?>)
                        <?php
                        if (strlen($telefone->numero) == 9) {
                            echo substr($telefone->numero, 0, 5) . '-' . substr($telefone->numero, 5);
                        } else {
                            echo substr($telefone->numero, 0, 4) . '-' . substr($telefone->numero, 4);
                        }
                        echo '  ';
                        ?>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="col-12">
                <br>
            </div>
            <div class="col-4">
                <br><button class="btListas"><a><i class="fas fa-user-cog"></i> Atualizar Seus Dados</a></button>
            </div>
            <div class="col-8">
                <br><br><p>Atualize informações pessoais, dados de conta, endereço e telefones.</p><br>
            </div>
            <div class="col-4">
                <br><button class="btListas"><a><i class="fas fa-user-times"></i> Desativar Sua Conta</a></button>
            </div>
            <div class="col-8">
                <br><br><p>Desativar sua conta impedirá seu acesso ao Gifty no futuro.</p><br>
            </div>
        </div>
    </section>    
</main>