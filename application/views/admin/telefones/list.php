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
                <h1>Telefones</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/telefones/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($telefones as $telefone) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-10">
                    <h2># <?= $telefone->id ?></h2>
                </div>            
                <div class="col-2">
                    <button class='bt'><a href="<?= base_url('admin/telefones/excluir/' . $telefone->id) ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir endereço de código <?= $telefone->id ?>?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                    <button class='bt'><a href="<?= base_url('admin/telefones/atualizar/' . $telefone->id) ?>">
                            <i class="fas fa-edit"></i></a></button>

                </div>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-12">
                    (<?= $telefone->ddd ?>)
                    <?php
                    if (strlen($telefone->numero) == 9) {
                        echo substr($telefone->numero, 0, 5) . '-' . substr($telefone->numero, 5);
                    } else {
                        echo substr($telefone->numero, 0, 4) . '-' . substr($telefone->numero, 4);
                    }
                    ?>
                </div>
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>