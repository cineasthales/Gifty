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
                <h1>Adicionar Empresa</h1>
            </div>
            <form method="post" action="<?= base_url('admin/empresas/grava_adicao') ?>">
                <div class="col-6">
                    <label for="razaoSocial">Razão Social</label><br>
                    <input type="text" id="razaoSocial" name="razaoSocial" required
                           pattern="[A-Za-z0-9]{,100}" maxlength="100"><br><br>
                </div>
                <div class="col-6">
                    <label for="nomeFantasia">Nome Fantasia</label><br>
                    <input type="text" id="nomeFantasia" name="nomeFantasia" required
                           pattern="[A-Za-z0-9]{,50}" maxlength="50"><br><br>
                </div>
                <div class="col-6">
                    <label for="cnpj">CNPJ</label><br>
                    <input type="text" id="cnpj" name="cnpj" required placeholder="99999999999999"
                           pattern="[0-9]{,14}" maxlength="14"><br><br>
                </div>
                <div class="col-6">
                    <label for="email">Email</label><br>
                    <input type="email" id="email" name="email" required
                           pattern="[A-Za-z0-9]{,100}" maxlength="100"><br><br>
                </div>
                <div class="col-6">
                    <label for="site">Site</label><br>
                    <input type="text" id="site" name="site" required
                           pattern="[A-Za-z0-9]{,100}" maxlength="100"><br><br>
                </div>                
<!--                <div class="col-5">
                    <label for="logomarca">Logomarca</label><br>
                    <input type="file" id="logomarca" name="logomarca" accept=".gif, .jpg, .jpeg, .png"><br><br>
                </div>                -->
                <span style='text-align: right'>
                    <div class="col-6"><br>
                        <label for="ativa">
                            <input type="checkbox" id="ativa" name="ativa"> Ativa
                        </label><br><br>
                    </div>
                </span>
                <div class="col-12">
                    <br>
                    <input type="submit" value="Salvar"><br>
                </div>
            </form>
        </div>
    </section>    
</main>