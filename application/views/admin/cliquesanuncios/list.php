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
                <h1>Cliques em Anúncios</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/cliques/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
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
                    <?= $clique->url ?> em <?= date_format(date_create($clique->data), 'd/m/Y') ?>
                    às <?= substr($clique->hora, 0, 5) ?>
                </div>                
                <div class="col-2">
                    <button class='bt'><a href="<?= base_url('admin/cliques/excluir/' . $clique->id) ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir clique de código <?= $clique->id ?>?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                    <button class='bt'><a href="<?= base_url('admin/cliques/atualizar/' . $clique->id) ?>">
                            <i class="fas fa-edit"></i></a></button>

                </div>
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>