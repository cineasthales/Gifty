<?php
if ($this->session->has_userdata('mensagem')) {
    $mensagem = $this->session->flashdata('mensagem');
    $tipo = $this->session->flashdata('tipo');
    if ($tipo) {
        ?>
        <section class="alerta_sucesso">
            <div class="row-plus">
                <div class="col-11">
                    <small><strong>Sucesso!</strong> <?= $mensagem ?></small>
                </div>
                <div class="col-1">
                    <small id="xis"><a href="#">X</a></small>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <section class="alerta_erro">
            <div class="row-plus">
                <div class="col-11">
                    <small><strong>Erro.</strong> <?= $mensagem ?></small>
                </div>
                <div class="col-1">
                    <small id="xis"><a href="#">X</a></small>
                </div>
            </div>
        </section>
        <?php
    }
}
?>
<main>
    <section>
        <div class="row-plus"> 
            <div class="col-10">
                <h1>Usuários</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/usuarios/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($usuarios as $usuario) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-10">
                    <h2># <?= $usuario->id ?></h2>
                </div>            
                <div class="col-2">
                    <button class='bt'><a href="<?= base_url('admin/usuarios/excluir/' . $usuario->id) ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir usuário de código <?= $usuario->id ?>?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                    <button class='bt'><a href="<?= base_url('admin/usuarios/atualizar/' . $usuario->id) ?>">
                            <i class="fas fa-edit"></i></a></button>

                </div>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-4">
                    <img src="<?= base_url('assets/img/misc/generic-profile.jpg') ?>" 
                         alt="Foto de perfil de <?= $usuario->nome ?> <?= $usuario->sobrenome ?>">
                </div>
                <div class="col-8">
                    <strong><?= $usuario->nome ?> <?= $usuario->sobrenome ?></strong>
                </div>
                <div class="col-4">
                    <?= $usuario->nomeUsuario ?>
                </div>
                <div class="col-4">
                    <?= $usuario->email ?>
                </div>         
                <div class="col-4">
                    <?= $usuario->genero ?>
                </div>
                <div class="col-4">
                    <?= date_format(date_create($usuario->dataNasc), 'd/m/Y') ?>
                </div>
                <div class="col-4">
                    <?=
                    substr($usuario->cpf, 0, 3) . '.' . substr($usuario->cpf, 3, 3) . '.'
                    . substr($usuario->cpf, 6, 3) . '-' . substr($usuario->cpf, 9, 2)
                    ?>
                </div>
                <div class="col-4">
                    <?php if ($usuario->notificaEmail) { ?>
                        Com notificações
                    <?php } else { ?>
                        Sem notificações
                    <?php } ?>
                </div>
                <div class="col-4">
                    <?php if ($usuario->tentaLogin < 5) { ?>
                        Desbloqueado
                    <?php } else { ?>
                        Bloqueado
                    <?php } ?>
                </div>
                <div class="col-4">
                    <?php if ($usuario->ativo) { ?>
                        <strong><span style='color: #339900'>ATIVO</span></strong>
                    <?php } else { ?>
                        <strong><span style='color: red'>INATIVO</span></strong>
                    <?php } ?>
                </div>            
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
        </div>
    </section>    
</main>