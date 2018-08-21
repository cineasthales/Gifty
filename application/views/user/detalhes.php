<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Detalhes da Lista</h1><br>
            </div>
            <div class="col-3">
                <h2>Evento</h2><br>            
            </div>
            <div class="col-9">
                <button class="btListas"><a href="#"><i class="fas fa-calendar-alt"></i> Atualizar Evento</a></button><br>            
            </div>
            <div class="col-12">
                <ul>
                    <li><strong>Anfitrião</strong>: <?= $evento->nome ?> <?= $evento->snome ?></li>
                    <li><strong>Tipo</strong>: <?= $evento->tipo ?></li>
                    <li><strong>Título</strong>: <?= $evento->titulo ?></li>
                    <li><strong>Data</strong>: <?= $evento->data ?></li>
                    <li><strong>Hora</strong>: <?= $evento->hora ?></li>
                    <li><strong>Local</strong>: <?= $evento->local ?></li>
                    <li><strong>Endereço</strong>: <?= $evento->logradouro ?>, <?= $evento->numero ?>
                        <?php if (isset($evento->complemento)) { ?>
                            - <?= $evento->complemento ?>
                        <?php } ?>
                        - <?= $evento->bairro ?> - <?= $evento->numero ?> - <?= $evento->cep ?> -
                        <?= $evento->cidade ?>/<?= $evento->estado ?></li>
                    <li><strong>Descrição</strong>: <?= $evento->descricao ?></li>
                    <li><strong>Máximo de Itens por Convidados</strong>: <?= $evento->maxItens ?></li>
                    <li><strong>Data Limite de Confirmação</strong>: <?= $evento->dataLimite ?></li>                
                </ul>             
            </div>
            <div class="col-3">
                <h2>Convidados</h2><br>            
            </div>
            <div class="col-9">
                <button class="btListas"><a href="#"><i class="fas fa-id-card"></i> Atualizar Convites</a></button>            
            </div>
            <div class="col-12">
                <ul>
                    <?php foreach ($convidados as $convidado) { ?>
                        <li><strong><?= $convidado->nome ?> <?= $convidado->snome ?></strong></li>
                    <?php } ?>
                </ul> 
            </div>
            <div class="col-3">
                <h2>Lista</h2><br>            
            </div>
            <div class="col-9">
                <button class="btListas"><a href="#"><i class="fas fa-gift"></i> Atualizar Lista</a></button><br>           
            </div>
            <div class="col-12">
                <ul>
                    <?php foreach ($listas as $lista) { ?>
                        <li><strong><?= $lista->nome ?></strong></li>
                    <?php } ?>
                </ul> 
            </div>
        </div>
    </section>    
</main>