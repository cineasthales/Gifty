<main>
    <section>
        <div class="row"> 
            <div class="col-3">
                <h1>Início</h1>
            </div>
            <div class="col-9">
                <button id="btCriarLista"><a href="<?= base_url('usuario/criar') ?>"><i class="fas fa-th-list"></i> Criar Lista de Presentes</a></button>
            </div>
            <div class="col-12">
                <br><h2>Notificações</h2>
            </div>
            <?php if (count($logs) > 0) { ?>
                <div class="col-12">
                    <?php
                    $anterior = $logs[0];
                    foreach ($logs as $log) {
                        if ($log->acao->id != 9) {
                            if ($log->logData != $anterior) {
                                ?>
                                <br><br><div class="col-2"><strong><?= date_format(date_create($log->logData), 'd/m/Y') ?></strong></div>                        
                                <?php
                                $anterior = $log->logData;
                            } else {
                                ?>
                                <br><div class="col-2">&nbsp;</div>
                                <?php
                            }
                            ?>
                            <div class="col-10">
                                [<?= substr($log->logHora, 0, 5) ?>]
                                <?php if ($log->ativo == 1) { ?>
                                    "<a href="<?= base_url('usuario/listas/ver/') . $log->id ?>"><?= $log->titulo ?></a>" de
                                <?php } else { ?>
                                    "<?= $log->titulo ?>" de
                                <?php } ?>
                                <a href="<?= base_url('usuario/amigos/perfil/') . $log->idUsuario ?>"><?= $log->nome ?> <?= $log->snome ?></a> <?= $log->acao->descricao ?>.</div>
                            <br>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="col-12">
                    <p class="icon-big"><i class="fas fa-exclamation"></i></p><p>Você ainda não tem notificações.</p><br>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>