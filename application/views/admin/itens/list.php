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
            <div class="col-10">
                <h1>Itens</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/itens/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($itens as $item) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-10">
                    <h2># <?= $item->id ?></h2>
                </div>            
                <div class="col-2">
                    <button class='bt' id='btdel'><a href="<?= base_url('admin/itens/excluir/' . $item->id) ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir item de código <?= $item->id ?>?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                    <button class='bt'><a href="<?= base_url('admin/itens/atualizar/' . $item->id) ?>">
                            <i class="fas fa-edit"></i></a></button>

                </div>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-4">
                    <img class="bdImg" src="<?= base_url('assets/img/itens/' . $item->imagem) ?>"  
                         alt="Foto de <?= $item->nome ?>">
                </div>
                <div class="col-2">
                    <strong>Nome</strong>
                </div>
                <div class="col-6">
                    <?= $item->nome ?>
                </div>                
                <div class="col-2">
                    <strong>Categoria</strong>
                </div>
                <div class="col-6">
                    <?= $item->categoria ?>
                </div>
                <div class="col-2">
                    <strong>Preço</strong>
                </div>
                <div class="col-6">
                    <?= number_format($item->preco, 2, ',', '.') ?>
                </div>
                <div class="col-2">
                    <strong>Descrição</strong>
                </div>
                <div class="col-6">
                    <?= $item->descricao ?>
                </div>
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>