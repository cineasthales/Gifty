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
            <div class="col-5">
                <h1>Categorias</h1>
            </div>
            <form method="post" action="<?= base_url('admin/categorias') ?>">
                <div class="col-2">
                    <label for="filtro" hidden>Filtro</label>
                    <select id="filtro" name="filtro">
                        <option value="0">------</option>
                        <option value="1">ID</option>
                        <option value="2">Descrição</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="busca" hidden>Buscar</label>
                    <input type="search" id="busca" name="busca">
                </div>                
                <div class="col-1">
                    <button id='btsearch' type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="col-1">
                <button class='bt'><a href="<?= base_url('admin/categorias/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <?php if (count($categorias) > 1) { ?>
                    <small><strong><?= count($categorias) ?> registros encontrados.</strong></small>
                <?php } else if (count($categorias) == 1) { ?>
                    <small><strong><?= count($categorias) ?> registro encontrado.</strong></small>
                <?php } else { ?>
                    <small><strong>Nenhum registro encontrado.</strong></small>
                <?php } ?>              
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($categorias as $categoria) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-1">
                    <h2># <?= $categoria->id ?></h2>
                </div>            
                <div class="col-9">
                    <?= $categoria->descricao ?>
                </div>
                <div class="col-2">
                    <button class='bt' id='btdel'><a href="<?= base_url('admin/categorias/excluir/' . $categoria->id) ?>"
                                                     onclick="return confirm('Tem certeza que deseja excluir tipo de interesse de código <?= $categoria->id ?>?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                    <button class='bt'><a href="<?= base_url('admin/categorias/atualizar/' . $categoria->id) ?>">
                            <i class="fas fa-edit"></i></a></button>

                </div>
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
        </div>
    </section>    
</main>