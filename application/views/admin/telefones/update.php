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
                <h1>Atualizar Telefone</h1>
            </div>
            <form method="post" action="<?= base_url('admin/telefones/grava_atualizacao/') . $telefone->id ?>">
                <div class="col-3">
                    <label for="numero">DDD</label><br>
                    <input type="text" id="ddd" name="ddd" required value="<?= $telefone->ddd ?>"
                           pattern="[0-9]{,3}" maxlength="3"><br><br>
                </div>
                <div class="col-9">
                    <label for="numero">Número</label><br>
                    <input type="text" id="numero" name="numero" required value="<?= $telefone->numero ?>"
                           pattern="[0-9]{,20}" maxlength="20"><br><br>
                </div>
                <div class="col-12">
                    <label for="idUsuario">Usuário</label><br>
                    <select id="idUsuario" name="idUsuario" size="5">
                        <?php foreach ($usuarios as $usuario) { ?>
                            <?php if ($usuario->id == $telefone->idUsuario) { ?>                       
                                <option selected value="<?= $usuario->id ?>">                             
                                    # <?= $usuario->id ?> - <?= $usuario->nome ?> <?= $usuario->sobrenome ?>
                                    - <?= $usuario->nomeUsuario ?> - <?= $usuario->email ?>
                                </option>
                            <?php } else { ?>
                                <option value="<?= $usuario->id ?>">                             
                                    # <?= $usuario->id ?> - <?= $usuario->nome ?> <?= $usuario->sobrenome ?>
                                    - <?= $usuario->nomeUsuario ?> - <?= $usuario->email ?>
                                </option>
                            <?php } ?>
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