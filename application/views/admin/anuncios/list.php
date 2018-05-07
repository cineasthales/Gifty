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
                <h1>Anúncios</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/anuncios/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($anuncios as $anuncio) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-10">
                    <h2># <?= $anuncio->id ?></h2>
                </div>            
                <div class="col-2">
                    <button class='bt'><a href="<?= base_url('admin/anuncios/excluir/' . $anuncio->id) ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir anuncio de código <?= $anuncio->id ?>?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                    <button class='bt'><a href="<?= base_url('admin/anuncios/atualizar/' . $anuncio->id) ?>">
                            <i class="fas fa-edit"></i></a></button>

                </div>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-4">
                    <img src="<?= base_url('assets/img/misc/generic-profile.jpg') ?>" 
                         alt="Anúncio de <?= $anuncio->empresa ?>"
                         style="height: 10em; display: block; margin: 0 auto;">
                </div>
                <div class="col-2">
                    <strong>Empresa</strong>
                </div>
                <div class="col-6">
                    <?= $anuncio->empresa ?>
                </div>
                <div class="col-2">
                    <strong>URL</strong>
                </div>
                <div class="col-6">
                    <a href="<?= $anuncio->url ?>" target="_blank"><?= $anuncio->url ?></a>
                </div>                
                <div class="col-2">
                    <strong>Status</strong>
                </div>
                <div class="col-6">
                    <?php if ($anuncio->ativo) { ?>
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
    </section>    
</main>