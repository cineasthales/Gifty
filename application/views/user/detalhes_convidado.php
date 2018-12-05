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
            <div class="col-12">
                <h1>Ver Lista e Evento</h1><br>
            </div>
            <div class="col-12">
                <h2>Evento</h2><br>            
            </div>
            <div class="col-8">
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
                    <br><br><strong>Descrição</strong>:<br><?= $evento->descricao ?><br>
                </p>
            </div>            
            <div class="col-4">
                <img style="width: 100%" src="<?= base_url('assets/img/profiles/') . $evento->imagem ?>"><br><br>
                <?php if ($convidado->comparecera == 1) { ?>
                    <button class="btListas"><a onclick="return confirm('Tem certeza que deseja desconfirmar presença neste evento?')" href="<?= base_url('usuario/atualizar/desconfirmar_presenca_lista/') . $this->session->id . '/' . $convidado->idEvento ?>"><i class="fas fa-times-circle"></i> Desconfirmar Presença</a></button><br>
                <?php } else { ?>
                    <button class="btListas"><a onclick="return confirm('Confirmar presença neste evento?')" href="<?= base_url('usuario/atualizar/confirmar_presenca_lista/') . $this->session->id . '/' . $convidado->idEvento ?>"><i class="fas fa-check-circle"></i> Confirmar Presença</a></button><br>
                <?php } ?>
            </div>
            <div class="col-8">
                <br><br><h2>Lista de Presentes</h2><br>            
            </div>            
            <?php if ($convidado->comparecera == 1) { ?>
                <div class="col-12">
                    <?php if (count($listas) > 0) { ?>                        
                        <div style="overflow-x: auto"><table>
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
                                        <p>R$ <?= number_format($lista->preco, 2, ',', '.') ?></p>
                                    </td>
                                    <td>
                                        <p>Adicionado em<br><?= date_format(date_create($lista->dataAdicao), 'd/m/Y') ?></p>
                                    </td>
                                    <td>
                                        <?php if ($lista->idComprador == 0) { ?>
                                            <p style="font-size: 1.25em"><a onclick="return confirm('Marcar compra deste item?')" href="<?= base_url('usuario/atualizar/marcar/') . $lista->idEvento . '/' . $lista->idItem ?>"><i class="fas fa-check-circle"></i><br>Marcar<br>Compra</a></p>
                                        <?php } else if ($lista->idComprador == $this->session->id) { ?>
                                            <p style="font-size: 1.25em"><a onclick="return confirm('Tem certeza que deseja desmarcar compra deste item?')" href="<?= base_url('usuario/atualizar/desmarcar/') . $lista->idEvento . '/' . $lista->idItem ?>"><i class="far fa-minus-square"></i><br>Desmarcar<br>Compra</a></p>
                                        <?php } else { ?>
                                            <p>Outro convidado já comprou.</p>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </table></div>
                    <?php } else { ?>
                        <br><br><p class="icon-big"><i class="fas fa-gift"></i></p><p>Esta lista ainda está vazia. Volte novamente mais tarde. :)<br></p><br>
                        <br><br>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="col-12">
                    <p class="icon-big"><i class="fas fa-list-ol"></i></p><p>Você só tem acesso à lista de presentes após confirmar presença no evento.</p>
                </div>
            <?php } ?>
        </div>
        </div>
    </section>    
</main>