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
                <h1>Adicionar Convidado</h1>
            </div>
            <form method="post" action="<?= base_url('admin/convidados/grava_adicao') ?>">
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
                <span style='text-align: center'>
                    <div class="col-4"><br>
                        <label for="comparecera">
                            <input type="checkbox" id="comparecera" name="comparecera"> Comparecerá
                        </label><br><br>
                    </div>
                    <div class="col-4"><br>
                        <label for="compareceu">
                            <input type="checkbox" id="compareceu" name="compareceu"> Compareceu
                        </label><br><br>
                    </div>
                    <div class="col-4"><br>
                        <label for="bloqueado">
                            <input type="checkbox" id="bloqueado" name="bloqueado"> Bloqueado
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