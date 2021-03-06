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
            <div class="col-3">
                <h1>Empresas</h1>
            </div>
            <form method="post" action="<?= base_url('admin/empresas') ?>">
                <div class="col-3">
                    <label for="filtro" hidden>Filtro</label>
                    <select id="filtro" name="filtro">
                        <option value="0">------</option>
                        <option value="1">ID</option>                        
                        <option value="2">Nome Fantasia</option>
                        <option value="3">Razão Social</option>   
                        <option value="4">CNPJ</option>                        
                    </select>
                </div>
                <div class="col-4">
                    <label for="busca" hidden>Buscar</label>
                    <input type="search" id="busca" name="busca">
                </div>                
                <div class="col-1">
                    <button id='btsearch' type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="col-1">
                <button class='bt'><a href="<?= base_url('admin/empresas/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <?php if (count($empresas) > 1) { ?>
                    <small><strong><?= count($empresas) ?> registros encontrados.</strong></small>
                <?php } else if (count($empresas) == 1) { ?>
                    <small><strong><?= count($empresas) ?> registro encontrado.</strong></small>
                <?php } else { ?>
                    <small><strong>Nenhum registro encontrado.</strong></small>
                <?php } ?>              
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
                    <?=
                    substr($empresa->cnpj, 0, 2) . '.' . substr($empresa->cnpj, 2, 3) . '.'
                    . substr($empresa->cnpj, 5, 3) . '/' . substr($empresa->cnpj, 8, 4) . '-'
                    . substr($empresa->cnpj, 12, 2)
                    ?>
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