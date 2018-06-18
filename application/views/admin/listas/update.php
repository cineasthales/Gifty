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
                <h1>Atualizar em Lista</h1>
            </div>
            <div class="col-12">
                <h2><strong>Evento</strong>: # <?= $lista->idEvento ?> - <?= $lista->evento ?></h2>
            </div>
            <div class="col-12">
                <h2><strong>Item</strong>: # <?= $lista->idItem ?> - <?= $lista->item ?></h2>
            </div>            
            <form method="post" action="<?= base_url('admin/listas/grava_atualizacao/') . $lista->idEvento . '/' . $lista->idItem ?>">               
                <div class="col-6">
                    <label for="prioridade">Prioridade</label><br>
                    <input type="number" id="prioridade" name="prioridade" required min="1" max="999" value="<?= $lista->prioridade ?>"><br><br>
                </div>
                <div class="col-6">
                    <label for="idComprador">Código do Comprador</label><br>
                    <input type="text" id="idComprador" name="idComprador" pattern="[0-9]" value="<?= $lista->idComprador ?>"><br><br>
                </div>
                <div class="col-12">
                    <label for="dataAdicao">Data de Adição</label><br>
                    <input type="date" id="dataAdicao" name="dataAdicao" required value="<?= $lista->dataAdicao ?>"><br><br>
                </div>
                <div class="col-12">
                    <br>
                    <input type="submit" value="Salvar"><br>
                </div>
            </form>
        </div>
    </section>    
</main>