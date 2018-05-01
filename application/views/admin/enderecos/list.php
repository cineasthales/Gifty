<?php
if ($this->session->has_userdata('mensagem')) {
    $mensagem = $this->session->flashdata('mensagem');
    $tipo = $this->session->flashdata('tipo');
    if ($tipo) {
        ?>
        <section class="alerta_sucesso">
            <div class="row-plus">
                <div class="col-11">
                    <small><strong>Sucesso!</strong> <?= $mensagem ?></small>
                </div>
                <div class="col-1">
                    <small id="xis"><a href="#">X</a></small>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <section class="alerta_erro">
            <div class="row-plus">
                <div class="col-11">
                    <small><strong>Erro.</strong> <?= $mensagem ?></small>
                </div>
                <div class="col-1">
                    <small id="xis"><a href="#">X</a></small>
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
                <h1>Endereços</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/enderecos/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
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
                <div class="col-10">
                    <h2># <?= $endereco->id ?></h2>
                </div>            
                <div class="col-2">
                    <button class='bt'><a href="<?= base_url('admin/enderecos/excluir/' . $endereco->id) ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir endereço de código <?= $endereco->id ?>?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                    <button class='bt'><a href="<?= base_url('admin/enderecos/atualizar/' . $endereco->id) ?>">
                            <i class="fas fa-edit"></i></a></button>

                </div>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-12">
                    <?= $endereco->logradouro ?>, <?= $endereco->numero ?>
                    <?php
                    if ($endereco->complemento) {
                        echo ' - $endereco->complemento ?> ';
                    }
                    ?>
                    - <?= $endereco->bairro ?> - <?=
                    substr($endereco->cep, 0, 2) . '.' . substr($endereco->cep, 2, 3) . '-'
                    . substr($endereco->cep, 5, 3)
                    ?> 
                    - <?= $endereco->cidade ?> / <?= $endereco->estado ?>
                </div>
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
        </div>
    </section>    
</main>