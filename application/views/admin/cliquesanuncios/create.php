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
                <h1>Adicionar Clique em Anúncio</h1>
            </div>
            <form method="post" action="<?= base_url('admin/cliquesanuncios/grava_adicao') ?>">
                <div class="col-6">
                    <label for="data">Data</label><br>
                    <input type="date" id="data" name="data" required><br><br>
                </div>
                <div class="col-6">
                    <label for="hora">Hora</label><br>
                    <input type="time" id="hora" name="hora" required><br><br>
                </div>
                <div class="col-12">
                    <label for="idUsuario">Usuário</label><br>
                    <select id="idUsuario" name="idUsuario" size="5">
                        <?php foreach ($usuarios as $usuario) { ?>
                            <option value="<?= $usuario->id ?>">                             
                                # <?= $usuario->id ?> - <?= $usuario->nome ?> <?= $usuario->sobrenome ?>
                                - <?= $usuario->nomeUsuario ?> - <?= $usuario->email ?>
                            </option>
                        <?php } ?>
                    </select><br><br>
                </div>
                <div class="col-12">
                    <label for="idAnuncio">Anúncio</label><br>
                    <select id="idAnuncio" name="idAnuncio" size="5">
                        <?php foreach ($anuncios as $anuncio) { ?>
                            <option value="<?= $anuncio->id ?>">                             
                                # <?= $anuncio->id ?> - <?= $anuncio->url ?>
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