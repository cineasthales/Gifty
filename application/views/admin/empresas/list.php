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
                <h1>Empresas</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/empresas/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($empresas as $empresa) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-10">
                    <h2># <?= $empresa->id ?></h2>
                </div>            
                <div class="col-2">
                    <button class='bt' id='btdel'><a href="<?= base_url('admin/empresas/excluir/' . $empresa->id) ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir empresa de código <?= $empresa->id ?>?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                    <button class='bt'><a href="<?= base_url('admin/empresas/atualizar/' . $empresa->id) ?>">
                            <i class="fas fa-edit"></i></a></button>

                </div>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-4">
                    <img class="bdImg" src="<?= base_url('assets/img/companies/' . $empresa->logomarca) ?>"  
                         alt="Logo de <?= $empresa->nomeFantasia ?>"><br><br><br>
                </div>
                <div class="col-2">
                    <strong>Nome Fantasia</strong>
                </div>
                <div class="col-6">
                    <?= $empresa->nomeFantasia ?>
                </div>
                <div class="col-2">
                    <strong>Razão Social</strong>
                </div>
                <div class="col-6">
                    <?= $empresa->razaoSocial ?>
                </div>
                <div class="col-2">
                    <strong>E-mail</strong>
                </div>
                <div class="col-6">
                    <a href="mailto:<?= $empresa->email ?>" target="_blank"><?= $empresa->email ?></a>
                </div>
                <div class="col-2">
                    <strong>CNPJ</strong>
                </div>
                <div class="col-6">
                    <?= $empresa->cnpj ?>
                </div>
                <div class="col-2">
                    <strong>Site</strong>
                </div>
                <div class="col-6">
                    <a href="<?= $empresa->site ?>" target="_blank"><?= $empresa->site ?></a>
                </div>                
                <div class="col-2">
                    <strong>Status</strong>
                </div>
                <div class="col-6">
                    <?php if ($empresa->ativa) { ?>
                        <strong><span style='color: #339900'>ATIVA</span></strong>
                    <?php } else { ?>
                        <strong><span style='color: red'>INATIVA</span></strong>
                    <?php } ?>
                </div>            
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>