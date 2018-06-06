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
            <div class="col-12">
                <h1>Adicionar Anúncio</h1>
            </div>
            <form method="post" action="<?= base_url('admin/anuncios/grava_adicao') ?>">
                <div class="col-10">
                    <label for="url">URL</label><br>
                    <input type="text" id="url" name="url" pattern="[A-Za-z]{,100}" 
                           maxlength="100" required><br><br>
                </div>                
                <span style='text-align: right'>
                    <div class="col-2"><br>
                        <label for="ativo">
                            <input type="checkbox" id="ativo" name="ativo"> Ativo
                        </label><br><br>
                    </div>                    
                </span>
                <div class="col-12">
                    <label for="idEmpresa">Empresa</label><br>
                    <select id="idEmpresa" name="idEmpresa" size="5">
                        <?php foreach ($empresas as $empresa) { ?>
                            <option value="<?= $empresa->id ?>">                             
                                # <?= $empresa->id ?> - <?= $empresa->nomeFantasia ?> - <?= $empresa->site ?>                                
                            </option>
                        <?php } ?>
                    </select><br><br>
                </div>
                <div class="col-12">
                    <br>
                    <input type="submit" value="Salvar"><br>
                </div>
            </form>
        </div>
    </section>    
</main>