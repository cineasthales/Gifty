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
                            <?= substr($evento->hora, 0, 5) ?></h3>
                    </div>
                    <div class="col-3">
                        <button class="btListas"><a href="<?= base_url('usuario/listas/detalhes/') . $evento->id ?>"><i class="fas fa-info-circle"></i> Ver Detalhes</a></button><br>
                    </div>
                    <div class="col-3">
                        <button class="btListas"><a href="<?= base_url('usuario/atualizar/lista/') . $evento->id ?>"><i class="fas fa-gift"></i> Atualizar Lista</a></button><br>
                    </div>
                    <div class="col-3">
                        <button class="btListas"><a href="#"><i class="fas fa-id-card"></i> Atualizar Convites</a></button><br>
                    </div>
                    <div class="col-3">
                        <button class="btListas"><a href="<?= base_url('usuario/atualizar/evento/') . $evento->id ?>"><i class="fas fa-calendar-alt"></i> Atualizar Evento</a></button><br>
                    </div>
                    <div class="col-3">
                        <button class="btListas"><a href="<?= base_url('usuario/listas') ?>" onclick="return confirm('Tem certeza que deseja excluir <?= $evento->titulo ?>?')"><i class="fas fa-times"></i> Excluir Lista</a></button>
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
                    <div class="col-12">
                        <br>
                    </div>
                    <div class="col-2">
                        <img style="width: 100%; max-height: 8em" src="<?= base_url('assets/img/profiles/') . $convidado->idAnf . '.jpg' ?>"><br>
                    </div>
                    <div class="col-6">
                        <h3><strong><?= $convidado->evento ?></strong>
                            <br><br><strong><i class="fas fa-calendar-alt"></i></strong>
                            <?= date_format(date_create($convidado->data), 'd/m/Y') ?>
                            <br><br><strong><i class="fas fa-clock"></i></strong> <?= substr($convidado->hora, 0, 5) ?></h3>
                    </div>
                    <div class="col-4">
                        <button class="btListas"><a href="#"><i class="fas fa-gift"></i> Ver Lista</a></button><br>
                        <?php if ($convidado->comparecera) { ?>
                            <button class="btListas"><a href="#"><i class="fas fa-times-circle"></i> Desconfirmar Presença</a></button><br>
                        <?php } else { ?>
                            <button class="btListas"><a href="#"><i class="fas fa-check-circle"></i> Confirmar Presença</a></button><br>
                        <?php } ?>
                    </div>
                    <div class="col-12">
                        <br><hr>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="col-12">
                    <p class="icon-big"><i class="fas fa-id-card"></i></p><p>Você ainda não recebeu convites.</p><br>
                </div>               
            <?php } ?>
        </div>
    </section>    
</main>