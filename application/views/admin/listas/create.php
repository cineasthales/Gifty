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
                <h1>Adicionar em Lista</h1>
            </div>
            <form method="post" action="<?= base_url('admin/convidados/grava_adicao') ?>">
                <div class="col-12">
                    <label for="idEvento">Evento</label><br>
                    <select id="idEvento" name="idEvento" size="5">
                        <?php foreach ($eventos as $evento) { ?>
                            <option value="<?= $evento->id ?>">                             
                                # <?= $evento->id ?> - <?= $evento->titulo ?>
                                - <?= date_format(date_create($evento->data), 'd/m/Y') ?>
                                - <?= substr($evento->hora, 0, 5) ?>
                            </option>
                        <?php } ?>
                    </select><br><br>
                </div>
                <div class="col-12">
                    <label for="idItem">Item</label><br>
                    <select id="idItem" name="idItem" size="5">
                        <?php foreach ($itens as $item) { ?>
                            <option value="<?= $item->id ?>">                             
                                # <?= $item->id ?> - <?= $item->nome ?>
                            </option>
                        <?php } ?>
                    </select><br><br>
                </div>                
                <div class="col-6">
                    <label for="prioridade">Prioridade</label><br>
                    <input type="number" id="prioridade" name="prioridade" required min="1" max="999"><br><br>
                </div>
                <div class="col-6">
                    <label for="idComprador">Código do Comprador</label><br>
                    <input type="text" id="idComprador" name="idComprador" pattern="[0-9]"><br><br>
                </div>
                <div class="col-12">
                    <label for="dataAdicao">Data de Adição</label><br>
                    <input type="date" id="dataAdicao" name="dataAdicao" required><br><br>
                </div>
                <div class="col-12">
                    <br>
                    <input type="submit" value="Salvar"><br>
                </div>
            </form>
        </div>
    </section>    
</main>