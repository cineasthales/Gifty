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
            <div class="col-3">
                <h1>Endereços</h1>
            </div>
            <form method="post" action="<?= base_url('admin/enderecos') ?>">
                <div class="col-3">
                    <label for="filtro" hidden>Filtro</label>
                    <select id="filtro" name="filtro">
                        <option value="0">------</option>
                        <option value="1">ID</option>
                        <option value="2">Logradouro</option>
                        <option value="3">Bairro</option>
                        <option value="4">Cidade</option>
                        <option value="5">Estado</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="busca" hidden>Buscar</label>
                    <input type="search" id="busca" name="busca">
                </div>                
                <div class="col-1">
                    <button id='btsearch' type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="col-1">
                <button class='bt'><a href="<?= base_url('admin/enderecos/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <?php if (count($enderecos) > 1) { ?>
                    <small><strong><?= count($enderecos) ?> registros encontrados.</strong></small>
                <?php } else if (count($enderecos) == 1) { ?>
                    <small><strong><?= count($enderecos) ?> registro encontrado.</strong></small>
                <?php } else { ?>
                    <small><strong>Nenhum registro encontrado.</strong></small>
                <?php } ?>              
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($enderecos as $endereco) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-1">
                    <h2># <?= $endereco->id ?></h2>
                </div>
                <div class="col-9">
                    <?= $endereco->logradouro ?>, <?= $endereco->numero ?>
                    <?php
                    if ($endereco->complemento) {
                        echo ' - ' . $endereco->complemento;
                    }
                    ?>
                    - <?= $endereco->bairro ?> - <?=
                    substr($endereco->cep, 0, 2) . '.' . substr($endereco->cep, 2, 3) . '-'
                    . substr($endereco->cep, 5, 3)
                    ?> 
                    - <?= $endereco->cidade ?> / <?= $endereco->estado ?>
                </div>
                <div class="col-2">
                    <button class='bt' id='btdel'><a href="<?= base_url('admin/enderecos/excluir/' . $endereco->id) ?>"
                                                     onclick="return confirm('Tem certeza que deseja excluir endereço de código <?= $endereco->id ?>?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                    <button class='bt'><a href="<?= base_url('admin/enderecos/atualizar/' . $endereco->id) ?>">
                            <i class="fas fa-edit"></i></a></button>
                </div>
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>