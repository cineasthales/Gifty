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
                <h1>Atualizar Interesse</h1>
            </div>
            <div class="col-12">
                <h2><strong>Usuário</strong>: # <?= $interesse->idUsuario ?> - <?= $interesse->nome ?> <?= $interesse->snome ?></h2>
            </div>
            <div class="col-12">
                <h2><strong>Categoria</strong>: # <?= $interesse->idCategoria ?> - <?= $interesse->categoria ?></h2>
            </div>
            <form method="post" action="<?= base_url('admin/interesses/grava_atualizacao/') . $interesse->idUsuario . '/' . $interesse->idCategoria ?>">                
                <div class="col-12">
                    <label for="peso">Peso</label><br>
                    <input type="number" id="peso" name="peso" required min="1" max="5" value="<?= $interesse->peso ?>"><br><br>
                </div>
                <div class="col-12">
                    <br>
                    <input type="submit" value="Salvar"><br>
                </div>
            </form>
        </div>
    </section>    
</main>