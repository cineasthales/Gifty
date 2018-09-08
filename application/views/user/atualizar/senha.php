<?php
if ($this->session->has_userdata('mensagem')) {
    $mensagem = $this->session->flashdata('mensagem');
    $tipo = $this->session->flashdata('tipo');
    if ($tipo) {
        ?>
        <section class="alerta_sucesso">
            <div class="row">
                <div class="col-12">
                    <small><strong>Sucesso!</strong> <?= $mensagem ?></small>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <section class="alerta_erro">
            <div class="row">
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
        <div class="row"> 
            <div class="col-12">
                <h1>Trocar Senha</h1><br>
            </div>
            <form method="post" action="<?= base_url('usuario/configuracoes/grava_troca_senha') ?>">
                <div class="col-4">
                    <label for="senhaAtual">Senha atual</label>
                    <input type="password" id="senhaAtual" name="senhaAtual" required maxlength="32"><br>
                </div>
                <div class="col-4">
                    <label for="senha">Nova senha</label>
                    <input type="password" id="senha" name="senha" 
                           title="Mínimo 8 caracteres, pelo menos uma letra maiúscula, uma letra minúscula e um dígito." required
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}" maxlength="32"><br>
                </div>
                <div class="col-4">
                    <label for="senhaRep">Repita a nova senha</label>
                    <input type="password" id="senhaRep" name="senhaRep" 
                           title="Mínimo 8 caracteres, pelo menos uma letra maiúscula, uma letra minúscula e um dígito." required
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}" maxlength="32"><br>
                </div>
                <div class="col-12">
                    <br><br>
                    <input type="submit" value="Salvar"><br>
                </div>
            </form>
        </div>
    </section>
</main>