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
                <h1>Amizades</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/amizades/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($amizades as $amizade) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-11">
                    <strong><?= $amizade->nome1 ?> <?= $amizade->snome1 ?> (# <?= $amizade->idUsuario1 ?>)</strong>
                    é amigo(a) de <strong><?= $amizade->nome2 ?> <?= $amizade->snome2 ?> (# <?= $amizade->idUsuario2 ?>)</strong>
                    desde <?= date_format(date_create($amizade->dataAmizade), 'd/m/Y') ?>
                </div>
                <div class="col-1">
                    <button class='bt'><a href="<?=
                        base_url('admin/amizades/excluir/' . $amizade->idUsuario1 . '/'
                                . $amizade->idUsuario2)
                        ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir esta amizade?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                </div>
                <div class="col-2">
                    <?php if ($amizade->ativa) { ?>
                        <strong><span style='color: #339900'>ATIVA</span></strong>
                    <?php } else { ?>
                        <strong><span style='color: red'>INATIVA</span></strong>
                    <?php } ?>
                </div>
                <div class="col-10">
                    <?php if ($amizade->bloqueado1 && $amizade->bloqueado2) { ?>
                        Ambos os usuários bloquearam o outro.
                    <?php } else if ($amizade->bloqueado1) { ?>
                        <?= $amizade->nome2 ?> <?= $amizade->snome2 ?> bloqueou <?= $amizade->nome1 ?> <?= $amizade->snome1 ?>.
                    <?php } else if ($amizade->bloqueado2) { ?>
                        <?= $amizade->nome1 ?> <?= $amizade->snome1 ?> bloqueou <?= $amizade->nome2 ?> <?= $amizade->snome2 ?>.
                    <?php } ?>
                </div>
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>