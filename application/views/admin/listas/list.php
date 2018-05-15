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
                <h1>Listas</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/listas/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <?php if (count($listas) > 1) { ?>
                    <small><strong><?= count($listas) ?> registros encontrados.</strong></small>
                <?php } else if (count($listas) == 1) { ?>
                    <small><strong><?= count($listas) ?> registro encontrado.</strong></small>
                <?php } else { ?>
                    <small><strong>Nenhum registro encontrado.</strong></small>
                <?php } ?>              
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
                <div class="col-2">
                    <strong>Evento</strong>
                </div>
                <div class="col-8">
                    <?= $lista->evento ?> (# <?= $lista->idEvento ?>)
                </div>
                <div class="col-2">
                    <button class='bt'><a href="<?=
                        base_url('admin/listas/excluir/' . $lista->idEvento . '/'
                                . $lista->idItem)
                        ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir este item da lista?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                </div>
                <div class="col-2">
                    <strong>Item</strong>
                </div>
                <div class="col-10">
                    (<?= $lista->prioridade ?>º) <?= $lista->item ?>
                </div>                
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>