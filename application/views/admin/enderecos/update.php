<script src="<?= base_url('assets/js/ajax.js') ?>"></script>
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
                <h1>Atualizar Endereço</h1>
            </div>
            <form method="post" action="<?= base_url('admin/enderecos/grava_atualizacao/') . $endereco->id ?>">
                <div class="col-6">
                    <label for="CEP">CEP</label><br>
                    <input type="text" id="cep" name="cep" required title="Apenas os 8 números."
                           title="Apenas números." pattern="[0-9]{8}" maxlength="8"
                           placeholder="99999999" value="<?= $endereco->cep ?>"><br><br>
                </div>
                <div class="col-6">
                    <label for="logradouro">Logradouro</label><br>
                    <input type="text" id="logradouro" name="logradouro"
                           readonly value="<?= $endereco->logradouro ?>"><br><br>
                </div>
                <div class="col-6">
                    <label for="numero">Número</label><br>
                    <input type="text" id="numero" name="numero" required value="<?= $endereco->numero ?>"
                           pattern="[0-9]{,12}" maxlength="12"><br><br>
                </div>
                <div class="col-6">
                    <label for="complemento">Complemento</label><br>
                    <input type="text" id="complemento" name="complemento" value="<?= $endereco->complemento ?>"
                           pattern="[A-Za-z0-9]{,100}" maxlength="100"><br><br>
                </div>
                <div class="col-5">
                    <label for="bairro">Bairro</label><br>
                    <input type="text" id="bairro" name="bairro" readonly value="<?= $endereco->bairro ?>"><br><br><br>
                </div>
                <div class="col-5">
                    <label for="cidade">Cidade</label><br>
                    <input type="text" id="cidade" name="cidade" readonly value="<?= $endereco->cidade ?>"><br><br><br>
                </div>
                <div class="col-2">
                    <label for="estado">Estado</label><br>
                    <input type="text" id="estado" name="estado" readonly value="<?= $endereco->estado ?>"><br><br><br>
                </div>
                <div class="col-12">
                    <br>
                    <input type="submit" value="Salvar"><br>
                </div>
            </form>
        </div>
    </section>    
</main>