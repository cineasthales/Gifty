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
                <h1>Listas</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/listas/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($listas as $lista) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-10">
                    A lista do evento <strong><?= $lista->evento ?> (# <?= $lista->idEvento ?>)</strong>
                    tem o item <strong><?= $lista->item ?></strong>
                </div>
                <div class="col-2">
                    <button class='bt'><a href="<?=
                        base_url('admin/listas/excluir/' . $lista->idUsuario . '/'
                                . $lista->idTipolista)
                        ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir este item da lista?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                </div>
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>