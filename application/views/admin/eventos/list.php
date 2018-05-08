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
                <h1>Eventos</h1>
            </div>
            <div class="col-2">
                <button class='bt'><a href="<?= base_url('admin/eventos/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($eventos as $evento) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-10">
                    <h2># <?= $evento->id ?></h2>
                </div>            
                <div class="col-2">
                    <button class='bt'><a href="<?= base_url('admin/eventos/excluir/' . $evento->id) ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir evento de código <?= $evento->id ?>?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                    <button class='bt'><a href="<?= base_url('admin/eventos/atualizar/' . $evento->id) ?>">
                            <i class="fas fa-edit"></i></a></button>

                </div>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-2">
                    <strong>Anfitrião</strong>
                </div>
                <div class="col-10">
                    <?= $evento->nome ?> <?= $evento->snome ?> (# <?= $evento->idUsuario ?>)
                </div>
                <div class="col-2">
                    <strong>Tipo de Evento</strong>
                </div>
                <div class="col-10">
                    <?= $evento->tipo ?>
                </div>
                <div class="col-2">
                    <strong>Título</strong>
                </div>
                <div class="col-10">
                    <?= $evento->titulo ?>
                </div>
                <div class="col-2">
                    <strong>Data</strong>
                </div>
                <div class="col-10">
                    <?= date_format(date_create($evento->data), 'd/m/Y') ?>
                </div>
                <div class="col-2">
                    <strong>Hora</strong>
                </div>
                <div class="col-10">
                    <?= substr($evento->hora, 0, 5) ?>
                </div>
                <div class="col-2">
                    <strong>Local</strong>
                </div>
                <div class="col-10">
                    <?= $evento->local ?>
                </div>
                <div class="col-2">
                    <strong>Endereço</strong>
                </div>
                <div class="col-10">
                    <?= $evento->logradouro ?>, <?= $evento->numero ?>
                    <?php
                    if ($evento->complemento) {
                        echo ' - $evento->complemento ?> ';
                    }
                    ?>
                    - <?= $evento->bairro ?> - <?=
                    substr($evento->cep, 0, 2) . '.' . substr($evento->cep, 2, 3) . '-'
                    . substr($evento->cep, 5, 3)
                    ?> 
                    - <?= $evento->cidade ?> / <?= $evento->estado ?>
                </div>
                <div class="col-2">
                    <strong>Máximo de Itens</strong>
                </div>
                <div class="col-10">
                    <?= $evento->maxItens ?>
                </div>
                <div class="col-2">
                    <strong>Data Limite</strong>
                </div>
                <div class="col-10">
                    <?= date_format(date_create($evento->dataLimite), 'd/m/Y') ?>
                </div>                
                <div class="col-2">
                    <strong>Status</strong>
                </div>
                <div class="col-10">
                    <?php if ($evento->ativo) { ?>
                        <strong><span style='color: #339900'>ATIVO</span></strong>
                    <?php } else { ?>
                        <strong><span style='color: red'>INATIVO</span></strong>
                    <?php } ?>
                </div>            
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>