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
                <h1>Adicionar Item</h1>
            </div>
            <form method="post" action="<?= base_url('admin/itens/grava_adicao') ?>">
                <div class="col-6">
                    <label for="nome">Nome</label><br>
                    <input type="text" id="nome" name="nome" required
                           pattern="[A-Za-z0-9]{,240}" maxlength="240"><br><br>
                </div>
                <div class="col-6">
                    <label for="preco">Preço</label><br>
                    <input type="text" id="preco" name="preco" required><br><br>
                </div>
                <div class="col-12">
                    <label for="url">URL</label><br>
                    <input type="text" id="url" name="url" required maxlength="240"><br><br>
                </div>
                <div class="col-12">
                    <label for="descricao">Descrição</label><br>
                    <textarea id="descricao" name="descricao" pattern="[A-Za-z0-9]" rows="5" required></textarea><br><br>
                </div>
                <div class="col-12">
                    <label for="idCategoria">Categoria</label><br>
                    <select id="idCategoria" name="idCategoria" size="5">
                        <?php foreach ($categorias as $categoria) { ?>
                            <option value="<?= $categoria->id ?>">                             
                                # <?= $categoria->id ?> -  <?= $categoria->descricao ?>
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