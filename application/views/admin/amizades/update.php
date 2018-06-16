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
                <h1>Atualizar Amizade</h1>
            </div>
            <div class="col-12">
                <h2><strong>Usuário 1</strong>: # <?= $usuario1->id ?> - <?= $usuario1->nome ?> <?= $usuario1->sobrenome ?>
                    - <?= $usuario1->nomeUsuario ?> - <?= $usuario1->email ?></h2>
            </div>
            <div class="col-12">
                <h2><strong>Usuário 2</strong>: # <?= $usuario2->id ?> - <?= $usuario2->nome ?> <?= $usuario2->sobrenome ?>
                    - <?= $usuario2->nomeUsuario ?> - <?= $usuario2->email ?></h2>
            </div>
            <form method="post" action="<?= base_url('admin/amizades/grava_atualizacao/') . $amizade->idUsuario1 . '/' . $amizade->idUsuario2 ?>">
                <span style='text-align: center'>
                    <div class="col-4"><br>
                        <label for="ativa">
                            <?php
                            if ($amizade->ativa == 1) {
                                echo '<input type="checkbox" id="ativa" name="ativa" checked> Ativa';
                            } else {
                                echo '<input type="checkbox" id="ativa" name="ativa"> Ativa';
                            }
                            ?>
                        </label><br><br>
                    </div>
                    <div class="col-4"><br>
                        <label for="bloqueado1">
                            <?php
                            if ($amizade->bloqueado1 == 1) {
                                echo '<input type="checkbox" id="bloqueado1" name="bloqueado1" checked> Bloqueado 1';
                            } else {
                                echo '<input type="checkbox" id="bloqueado1" name="bloqueado1"> Bloqueado 1';
                            }
                            ?>
                        </label><br><br>
                    </div>
                    <div class="col-4"><br>
                        <label for="bloqueado2">
                            <?php
                            if ($amizade->bloqueado2 == 1) {
                                echo '<input type="checkbox" id="bloqueado2" name="bloqueado2" checked> Bloqueado 2';
                            } else {
                                echo '<input type="checkbox" id="bloqueado2" name="bloqueado2"> Bloqueado 2';
                            }
                            ?>
                        </label><br><br>
                    </div>
                </span>
                <div class="col-12">
                    <label for="data">Data</label><br>
                    <input type="date" id="data" name="data" required value="<?= $amizade->data ?>"><br><br>
                </div>
                <div class="col-12">
                    <br>
                    <input type="submit" value="Salvar"><br>
                </div>
            </form>
        </div>
    </section>    
</main>