<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Detalhes da Lista</h1><br>
            </div>
            <div class="col-9">
                <h2>Evento</h2><br>            
            </div>
            <div class="col-3">
                <button class="btListas"><a href="<?= base_url('usuario/atualizar/lista/') . $evento->id ?>"><i class="fas fa-calendar-alt"></i> Atualizar Evento</a></button><br>            
            </div>
            <div class="col-12">
                <h3><strong><?= $evento->titulo ?></strong></h3>
                <h4><?= $evento->tipo ?> de <?= $evento->nome ?> <?= $evento->snome ?></h4>
                <p><i class="fas fa-calendar-alt"></i> <?= date_format(date_create($evento->data), 'd/m/Y') ?>
                    - <i class="fas fa-clock"></i> <?= substr($evento->hora, 0, 5) ?>
                    - <i class="fas fa-map-marker-alt"></i> <?= $evento->local ?><br>
                    <?= $evento->logradouro ?>, <?= $evento->numero ?>
                    <?php if ($evento->complemento != "") { ?>
                        - <?= $evento->complemento ?>
                    <?php } ?>
                    - <?= $evento->bairro ?> - <?= $evento->numero ?>
                    - <?=
                    substr($evento->cep, 0, 2) . '.' . substr($evento->cep, 2, 3) . '-'
                    . substr($evento->cep, 5, 3)
                    ?>
                    - <?= $evento->cidade ?>/<?= $evento->estado ?><br><br></p>
                <p><?= $evento->descricao ?><br><br></p>
                <p><strong>Máximo de Itens por Convidados</strong>: <?= $evento->maxItens ?></p>
                <p><strong>Data Limite de Confirmação</strong>: <?= date_format(date_create($evento->dataLimite), 'd/m/Y') ?></p>        
            </div>
            <div class="col-9">
                <br><br><h2>Lista de Presentes</h2><br>            
            </div>
            <div class="col-3">
                <br><br><button class="btListas"><a href="<?= base_url('usuario/atualizar/lista/') . $evento->id ?>"><i class="fas fa-gift"></i> Atualizar Lista</a></button><br>           
            </div>
            <div class="col-12">
                <ul>
                    <?php foreach ($listas as $lista) { ?>
                        <li><strong><?= $lista->nome ?></strong></li>
                    <?php } ?>
                </ul> 
            </div>
            <div class="col-9">
                <br><br><h2>Convidados</h2><br>            
            </div>
            <div class="col-3">
                <br><br><button class="btListas"><a href="<?= base_url('usuario/atualizar/convidados/') . $evento->id ?>"><i class="fas fa-id-card"></i> Atualizar Convites</a></button>            
            </div>
            <div class="col-12">
                <ul>
                    <?php foreach ($convidados as $convidado) { ?>
                        <li><strong><?= $convidado->nome ?> <?= $convidado->snome ?></strong></li>
                    <?php } ?>
                </ul> 
            </div>
        </div>
    </section>    
</main>