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
                <h1>Adicionar Log de Evento</h1>
            </div>
            <form method="post" action="<?= base_url('admin/logeventos/grava_adicao') ?>">
                <div class="col-6">
                    <label for="data">Data</label><br>
                    <input type="date" id="data" name="data" required><br><br>
                </div>
                <div class="col-6">
                    <label for="hora">Hora</label><br>
                    <input type="time" id="hora" name="hora" required><br><br>
                </div>
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
                    <label for="idAcaoEvento">Ação</label><br>
                    <select id="idAcaoEvento" name="idAcaoEvento" size="5">
                        <?php foreach ($acoes as $acao) { ?>
                            <option value="<?= $acao->id ?>">                             
                                # <?= $acao->id ?> - <?= $acao->descricao ?>
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