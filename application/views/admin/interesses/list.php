<?php
if ($this->session->has_userdata('mensagem')) {
    $mensagem = $this->session->flashdata('mensagem');
    $tipo = $this->session->flashdata('tipo');
    if ($tipo) {
        ?>
        <section class="alerta_sucesso">
            <div class="row-plus">
                <div class="col-12">
                    <small><strong>Sucesso!</strong> <?= $mensagem ?></small>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <section class="alerta_erro">
            <div class="row-plus">
                <div class="col-12">
                    <small><strong>Erro.</strong> <?= $mensagem ?></small>
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
                <h1>Interesses</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/interesses/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($interesses as $interesse) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-10">
                    <strong><?= $interesse->nome ?> <?= $interesse->snome ?> (# <?= $interesse->idUsuario ?>)</strong>
                    tem interesse em <strong><?= $interesse->inter ?></strong>
                </div>
                <div class="col-2">
                    <button class='bt'><a href="<?=
                        base_url('admin/interesses/excluir/' . $interesse->idUsuario . '/'
                                . $interesse->idTipoInteresse)
                        ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir este interesse?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                </div>
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>