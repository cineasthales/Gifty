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
                <h1>Adicionar Amizade</h1>
            </div>
            <form method="post" action="<?= base_url('admin/amizades/grava_adicao') ?>">
                <div class="col-12">
                    <label for="idUsuario1">Usuário 1</label><br>
                    <select id="idUsuario1" name="idUsuario1" size="5">
                        <?php foreach ($usuarios as $usuario) { ?>
                            <option value="<?= $usuario->id ?>">                             
                                # <?= $usuario->id ?> - <?= $usuario->nome ?> <?= $usuario->sobrenome ?>
                                - <?= $usuario->nomeUsuario ?> - <?= $usuario->email ?>
                            </option>
                        <?php } ?>
                    </select><br><br>
                </div>
                <div class="col-12">
                    <label for="idUsuario2">Usuário 2</label><br>
                    <select id="idUsuario2" name="idUsuario2" size="5">
                        <?php foreach ($usuarios as $usuario) { ?>
                            <option value="<?= $usuario->id ?>">                             
                                # <?= $usuario->id ?> - <?= $usuario->nome ?> <?= $usuario->sobrenome ?>
                                - <?= $usuario->nomeUsuario ?> - <?= $usuario->email ?>
                            </option>
                        <?php } ?>
                    </select><br><br>
                </div>
                <span style='text-align: center'>
                    <div class="col-4"><br>
                        <label for="ativa">
                            <input type="checkbox" id="ativa" name="ativa"> Ativo
                        </label><br><br>
                    </div>
                    <div class="col-4"><br>
                        <label for="bloqueado1">
                            <input type="checkbox" id="bloqueado1" name="bloqueado1"> Bloqueado 1
                        </label><br><br>
                    </div>
                    <div class="col-4"><br>
                        <label for="bloqueado2">
                            <input type="checkbox" id="bloqueado2" name="bloqueado2"> Bloqueado 2
                        </label><br><br>
                    </div>
                </span>
                <div class="col-12">
                    <label for="data">Data</label><br>
                    <input type="date" id="data" name="data" required><br><br>
                </div>
                <div class="col-12">
                    <br>
                    <input type="submit" value="Salvar"><br>
                </div>
            </form>
        </div>
    </section>    
</main>