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
                <h1>Logs de Eventos</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/logeventos/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($logeventos as $logevento) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-1">
                    <h2># <?= $logevento->id ?></h2>
                </div>
                <div class="col-9">
                    <?= $logevento->evento ?> (# <?= $logevento->idEvento ?>) <?= $logevento->acao ?> em
                    <?= date_format(date_create($logevento->data), 'd/m/Y') ?> às <?= substr($logevento->hora, 0, 5) ?>
                </div>                
                <div class="col-2">
                    <button class='bt'><a href="<?= base_url('admin/logeventos/excluir/' . $logevento->id) ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir log de evento de código <?= $logevento->id ?>?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                    <button class='bt'><a href="<?= base_url('admin/logeventos/atualizar/' . $logevento->id) ?>">
                            <i class="fas fa-edit"></i></a></button>

                </div>
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>