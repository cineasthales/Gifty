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
                <h1>Convidados</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/convidados/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($convidados as $convidado) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-10">
                    O evento <strong><?= $convidado->evento ?> (# <?= $convidado->idEvento ?>)</strong>
                    tem o convidado <strong><?= $convidado->nome ?> <?= $convidado->snome ?>
                        (# <?= $convidado->idUsuario ?>)</strong>
                </div>
                <div class="col-2">
                    <button class='bt'><a href="<?=
                        base_url('admin/convidados/excluir/' . $convidado->idUsuario . '/'
                                . $convidado->idTipoconvidado)
                        ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir este item da convidado?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                </div>
                <div class="col-4">
                    <?php if (!$convidado->bloqueado) { ?>
                        <strong><span style='color: #339900'>ATIVO</span></strong>
                    <?php } else { ?>
                        <strong><span style='color: red'>CONVITE DESFEITO</span></strong>
                    <?php } ?>
                </div>                
                <div class="col-4">
                    <?php if ($convidado->comparecera) { ?>
                        Marcou comparecimento
                    <?php } else { ?>
                        Marcou não comparecimento
                    <?php } ?>
                </div>
                <div class="col-4">
                    <?php
                    if ($convidado->comparecera && $convidado->data >= date("Y-m-d") && $convidado->hora >= date("h:i")) {
                        if ($convidado->compareceu) {
                            ?>
                            Compareceu
                        <?php } else { ?>
                            Não compareceu
                            <?php
                        }
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