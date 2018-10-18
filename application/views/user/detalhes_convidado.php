<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Ver Lista</h1><br>
            </div>
            <div class="col-9">
                <h2>Evento</h2><br>            
            </div>
            <div class="col-3">
                <button class="btListas"><a href="<?= base_url('usuario/atualizar/evento/') . $evento->id ?>"><i class="fas fa-calendar-alt"></i> Atualizar Evento</a></button><br>            
            </div>
            <div class="col-12">
                <h3 style="font-size: 2em"><strong><?= $evento->titulo ?></strong></h3>
                <h4 style="color: black"><?= $evento->tipo ?> de <?= $evento->nome ?> <?= $evento->snome ?></h4><br>
                <p style="text-align: left">
                    <i class="fas fa-calendar-alt"></i> <?= date_format(date_create($evento->data), 'd/m/Y') ?>
                    <br><i class="fas fa-clock"></i> <?= substr($evento->hora, 0, 5) ?>
                    <br><i class="fas fa-map-marker-alt"></i> <?= $evento->local ?>
                    (<?= $evento->logradouro ?>, <?= $evento->numero ?>
                    <?php if ($evento->complemento != "") { ?>
                        - <?= $evento->complemento ?>
                    <?php } ?>
                    - <?= $evento->bairro ?>
                    - <?=
                    substr($evento->cep, 0, 2) . '.' . substr($evento->cep, 2, 3) . '-'
                    . substr($evento->cep, 5, 3)
                    ?>
                    - <?= $evento->cidade ?> / <?= $evento->estado ?>)<br><br>                
                    <strong>Máximo de Itens por Convidados</strong>: <?= $evento->maxItens ?>
                    <br><strong>Data Limite de Confirmação</strong>: <?= date_format(date_create($evento->dataLimite), 'd/m/Y') ?>
                    <br><br><strong>Descrição</strong>:<br><?= $evento->descricao ?><br><br>
                </p>
            </div>
            <div class="col-9">
                <br><br><h2>Lista de Presentes</h2><br>            
            </div>
            <div class="col-3">
                <br><br><button class="btListas"><a href="<?= base_url('usuario/atualizar/lista/') . $evento->id ?>"><i class="fas fa-gift"></i> Atualizar Lista</a></button><br>           
            </div>
            <div class="col-12">
                <table>
                    <?php foreach ($listas as $lista) { ?>
                        <tr>
                            <td>
                                <p style="font-size: 2em"><b><?= $lista->prioridade ?></b></p>
                            </td>
                            <td>
                                <img src="<?= $lista->imagem ?>" style="display: block; margin: 0 auto;">
                            </td>
                            <td>
                                <a href="<?= $lista->url ?>" target="_blank"><?= $lista->nome ?></a>
                            </td>
                            <td>
                                <button type="button">Marcar Compra</button>
                            </td>
                        </tr>
                    <?php } ?>
                </table> 
            </div>
        </div>
        </div>
    </section>    
</main>