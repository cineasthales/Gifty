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
            <div class="col-3">
                <h1>Listas</h1><br>
            </div>
            <div class="col-9">
                <button id="btCriarLista"><a href="<?= base_url('usuario/criar') ?>"><i class="fas fa-th-list"></i> Criar Lista de Presentes</a></button>
            </div>
            <div class="col-12">
                <h2>Suas Listas</h2><br>            
            </div>            
            <?php if (count($eventos) > 0) { ?> 
                <div class="col-12">
                    <hr>
                </div>
                <?php foreach ($eventos as $evento) { ?>
                    <div class="col-12">
                        <br>
                    </div>
                    <div class="col-9">
                        <h3><strong><?= $evento->titulo ?> - <i class="fas fa-calendar-alt"></i></strong>
                            <?= date_format(date_create($evento->data), 'd/m/Y') ?> - <i class="fas fa-clock"></i>
                            <?= substr($evento->hora, 0, 5) ?> - <i class="fas fa-map-marker-alt"></i> <?= $evento->local ?></h3>
                    </div>
                    <div class="col-3">
                        <button class="btListas"><a href="<?= base_url('usuario/listas/detalhes/') . $evento->id ?>"><i class="fas fa-info-circle"></i> Ver Detalhes</a></button><br>
                    </div>
                    <div class="col-3">
                        <button class="btListas"><a href="<?= base_url('usuario/atualizar/lista/') . $evento->id ?>"><i class="fas fa-gift"></i> Atualizar Lista</a></button><br>
                    </div>
                    <div class="col-3">
                        <button class="btListas"><a href="<?= base_url('usuario/atualizar/convidados/') . $evento->id ?>"><i class="fas fa-id-card"></i> Atualizar Convites</a></button><br>
                    </div>
                    <div class="col-3">
                        <button class="btListas"><a href="<?= base_url('usuario/atualizar/evento/') . $evento->id ?>"><i class="fas fa-calendar-alt"></i> Atualizar Evento</a></button><br>
                    </div>
                    <div class="col-3">
                        <button class="btListas"><a href="<?= base_url('usuario/atualizar/excluir/') . $evento->id ?>" onclick="return confirm('Tem certeza que deseja excluir <?= $evento->titulo ?>?')"><i class="fas fa-times"></i> Excluir Lista</a></button>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="col-12">
                    <p class="icon-big"><i class="fas fa-gift"></i></p><p>Você não tem listas ativas. Que tal <a href="<?= base_url('usuario/criar') ?>">criar uma</a>?</p><br>
                </div>
            <?php } ?>
            <div class="col-12">
                <br><br><h2>Convites para Você</h2><br>
            </div>            
            <?php if (count($convidados) > 0) { ?>
                <div class="col-12">
                    <hr>
                </div>
                <?php foreach ($convidados as $convidado) { ?>
                    <?php if ((date('Y-m-d') <= $convidado->dataLimite) || ((date('Y-m-d') > $convidado->dataLimite) && $convidado->comparecera == 1)) { ?>            
                        <div class="col-12">
                            <br>
                        </div>
                        <div class="col-2">
                            <img style="width: 100%; max-height: 8em" src="<?= base_url('assets/img/profiles/') . $convidado->imagem ?>"><br>
                        </div>
                        <div class="col-6">
                            <h3>
                                <strong><?= $convidado->titulo ?></strong>
                                <br><?= $convidado->tipo ?> de <?= $convidado->nome ?> <?= $convidado->snome ?></strong>
                                <br><br><strong><i class="fas fa-calendar-alt"></i></strong>
                                <?= date_format(date_create($convidado->data), 'd/m/Y') ?>
                                <br><strong><i class="fas fa-clock"></i></strong> <?= substr($convidado->hora, 0, 5) ?>
                                <?php if ($convidado->comparecera == 0) { ?>
                                    <br><strong>Confirme presença até <?= date_format(date_create($convidado->dataLimite), 'd/m/Y') ?></strong>
                                <?php } ?>
                            </h3>
                        </div>
                        <div class="col-4">
                            <button class="btListas"><a href="<?= base_url('usuario/listas/ver/') . $convidado->id ?>"><i class="fas fa-gift"></i> Ver Lista e Evento</a></button><br>
                            <?php if ($convidado->comparecera == 1) { ?>
                                <button class="btListas"><a onclick="return confirm('Tem certeza que deseja desconfirmar presença neste evento?')" href="<?= base_url('usuario/atualizar/desconfirmar_presenca/') . $this->session->id . '/' . $convidado->id ?>"><i class="fas fa-times-circle"></i> Desconfirmar Presença</a></button><br>
                            <?php } else { ?>
                                <button class="btListas"><a onclick="return confirm('Confirmar presença neste evento?')" href="<?= base_url('usuario/atualizar/confirmar_presenca/') . $this->session->id . '/' . $convidado->id ?>"><i class="fas fa-check-circle"></i> Confirmar Presença</a></button><br>
                            <?php } ?>
                        </div>
                        <div class="col-12">
                            <br><hr>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <div class="col-12">
                    <p class="icon-big"><i class="fas fa-id-card"></i></p><p>Você ainda não recebeu convites.</p><br>
                </div>               
            <?php } ?>
        </div>
    </section>    
</main>