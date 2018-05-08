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
                <h1>Cliques em Empresas</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/cliquesempresas/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($cliques as $clique) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-1">
                    <h2># <?= $clique->id ?></h2>
                </div>
                <div class="col-9">
                    <?= $clique->nome ?> <?= $clique->snome ?> (# <?= $clique->idUsuario ?>) clicou em
                    <?= $clique->empresa ?> em <?= date_format(date_create($clique->data), 'd/m/Y') ?>
                    às <?= substr($clique->hora, 0, 5) ?>
                </div>                
                <div class="col-2">
                    <button class='bt' id='btdel'><a href="<?= base_url('admin/cliquesempresas/excluir/' . $clique->id) ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir clique de código <?= $clique->id ?>?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                    <button class='bt'><a href="<?= base_url('admin/cliquesempresas/atualizar/' . $clique->id) ?>">
                            <i class="fas fa-edit"></i></a></button>

                </div>
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>