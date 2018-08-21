<main>
    <section>
        <div class="row"> 
            <div class="col-3">
                <h1>Listas</h1><br>
            </div>
            <div class="col-9">
                <button id="btCriarLista"><a href="<?= base_url('usuario/criar') ?>">Criar Lista</a></button>
            </div>
            <div class="col-12">
                <h2>Minhas Listas</h2><br>            
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
                        <button class="btListas"><a href="#"><i class="fas fa-gift"></i> Atualizar Lista</a></button><br>
                    </div>
                    <div class="col-3">
                        <button class="btListas"><a href="#"><i class="fas fa-id-card"></i> Atualizar Convites</a></button><br>
                    </div>
                    <div class="col-3">
                        <button class="btListas"><a href="#"><i class="fas fa-calendar-alt"></i> Atualizar Evento</a></button><br>
                    </div>
                    <div class="col-3">
                        <button class="btListas"><a href="#"><i class="fas fa-times"></i> Excluir Lista</a></button>
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
                <br><h2>Convites para mim</h2>
            </div>            
            <?php if (count($convidados) > 0) { ?>
                <div class="col-12">
                    <hr>
                </div>
                <?php foreach ($convidados as $convidado) { ?>
                    <div class="col-12">
                        <br>
                    </div>
                    <div class="col-6">
                        <h3><strong><?= $convidado->evento ?> - <i class="fas fa-calendar-alt"></i></strong>
                            <?= date_format(date_create($convidado->data), 'd/m/Y') ?> - <i class="fas fa-clock"></i>
                            <?= substr($convidado->hora, 0, 5) ?></h3>
                    </div>
                    <div class="col-2">
                        <button class="btListas"><a href="#"><i class="fas fa-gift"></i> Ver Lista</a></button><br>
                    </div>
                    <div class="col-4">
                        <?php if ($convidado->comparecera) { ?>
                            <button class="btListas"><a href="#"><i class="fas fa-times-circle"></i> Desconfirmar Presença</a></button><br>
                        <?php } else { ?>
                            <button class="btListas"><a href="#"><i class="fas fa-check-circle"></i> Confirmar Presença</a></button><br>
                        <?php } ?>
                    </div>
                    <div class="col-12">
                        <hr>
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