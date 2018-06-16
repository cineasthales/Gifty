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
                <h1>Atualizar Convidado</h1>
            </div>
            <div class="col-12">
                <h2><strong>Usuário</strong>: # <?= $usuario->id ?> - <?= $usuario->nome ?> <?= $usuario->sobrenome ?>
                    - <?= $usuario->nomeUsuario ?> - <?= $usuario->email ?></h2>
            </div>
            <div class="col-12">
                <h2><strong>Evento</strong>: # <?= $evento->id ?> - <?= $evento->titulo ?>
                    - <?= date_format(date_create($evento->data), 'd/m/Y') ?>
                    - <?= substr($evento->hora, 0, 5) ?></h2>
            </div>
            <form method="post" action="<?= base_url('admin/convidados/grava_atualizacao/') . $interesse->idUsuario . '/' . $interesse->idEvento ?>">
                <span style='text-align: center'>
                    <div class="col-4"><br>
                        <label for="comparecera">
                            <?php
                            if ($convidado->comparecera == 1) {
                                echo '<input type="checkbox" id="comparecera" name="comparecera" checked> Comparecerá';
                            } else {
                                echo '<input type="checkbox" id="comparecera" name="comparecera"> Comparecerá';
                            }
                            ?>
                        </label><br><br>
                    </div>
                    <div class="col-4"><br>
                        <label for="compareceu">
                            <?php
                            if ($convidado->compareceu == 1) {
                                echo '<input type="checkbox" id="compareceu" name="compareceu" checked> Compareceu';
                            } else {
                                echo '<input type="checkbox" id="compareceu" name="compareceu"> Compareceu';
                            }
                            ?>
                        </label><br><br>
                    </div>
                    <div class="col-4"><br>
                        <label for="bloqueado">
                            <?php
                            if ($convidado->bloqueado == 1) {
                                echo '<input type="checkbox" id="bloqueado" name="bloqueado" checked> Bloqueado';
                            } else {
                                echo '<input type="checkbox" id="bloqueado" name="bloqueado"> Bloqueado';
                            }
                            ?>
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