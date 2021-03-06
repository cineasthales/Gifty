<main>
    <section>
        <div class="row"> 
            <div class="col-8">
                <h1>Atualizar Lista</h1>
            </div>
            <div class="col-4">
                <br><button id="btFinalizar">
                    <a href="<?= base_url('usuario/atualizar/finalizar') ?>">Finalizar</a></button>
            </div>
            <div class="col-12">
                <?php if (count($itens) > 0) { ?>
                    <br><br><div style="overflow-x: auto"><table>
                        <tr>
                            <th>Posição</th>
                            <th>Item</th>
                            <th>Adicionado em</th>
                            <th>Ações</th>
                        </tr>
                        <?php for ($i = 0; $i < count($itens); ++$i) { ?>
                            <tr>
                                <td><?= $itens[$i]->prioridade ?></td>
                                <td><a href="<?= $itens[$i]->url ?>" target="_blank"><?= $itens[$i]->nome ?></a></td>
                                <td><?= date_format(date_create($itens[$i]->dataAdicao), 'd/m/Y') ?></td>
                                <td>
                                    <?php if (count($itens) > 1) { ?>
                                        <?php if ($i > 0) { ?>
                                            <a href="<?= base_url('usuario/atualizar/subir/') . $itens[$i]->idItem . '/' . $itens[$i]->idEvento ?>"><i class="fas fa-chevron-circle-up"></i></a>
                                        <?php } ?>                                            
                                        <?php if ($i < count($itens) - 1) { ?>
                                            <a href="<?= base_url('usuario/atualizar/descer/') . $itens[$i]->idItem . '/' . $itens[$i]->idEvento ?>"><i class="fas fa-chevron-circle-down"></i></i></a>
                                        <?php } ?>
                                    <?php } ?>
                                    <a href="<?= base_url('usuario/atualizar/excluir_item/') . $itens[$i]->idEvento . '/' . $itens[$i]->idItem ?>"><i class="fas fa-minus-circle"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </table></div><br><br>
                <?php } else { ?>
                    <br><br><p class="icon-big"><i class="fas fa-gift"></i></p><p>Sua lista ainda está vazia.<br>Você pode buscar itens ou adicionar nossas recomendações.</p><br>
                    <br><br>
                <?php } ?>
            </div>
            <div class="col-6">
                <h2>Itens Recomendados Para Você</h2><br>
            </div>
            <form method="post" action="<?= base_url('usuario/atualizar/busca/' . $idEvento) ?>">
                <div class="col-5">                    
                    <input type="text" id="busca" name="busca" pattern="[A-Za-z0-9]{,100}" 
                           maxlength="100" required placeholder="Buscar itens">
                </div>
                <div class="col-1">
                    <button id='btsearch' style="font-size: 0.75em;" type="submit"><i class="fas fa-search"></i></button><br><br>
                </div>
            </form>
            <?php if (isset($json)) { ?>                
                <?php foreach ($json as $item) { ?>
                    <form method="post" action="<?= base_url('usuario/atualizar/adicionar/' . $idEvento) ?>">
                        <div class="col-3" style="height: 22em;">
                            <a href="<?= $item->permalink ?>" target='_blank'>
                                <img style="width: 40%; display: block; margin: 0 auto" src="<?= $item->thumbnail ?>"><br>
                                <p><?= $item->title ?></p><br>
                            </a>
                            <p>R$ <?= number_format($item->price, 2, ',', '.') ?></p><br>             
                            <input hidden type="text" id="nome" name="nome" value="<?= $item->title ?>">
                            <input hidden type="text" id="url" name="url" value="<?= $item->permalink ?>">
                            <input hidden type="text" id="descricao" name="descricao" value="-">
                            <input hidden type="text" id="idCategoria" name="idCategoria" value="<?= $item->category_id ?>">
                            <input hidden type="text" id="preco" name="preco" value="<?= $item->price ?>">
                            <input hidden type="text" id="imagem" name="imagem" value="<?= $item->thumbnail ?>">
                            <input type="submit" value="Adicionar"><br><br><br><br><br>
                        </div>
                    </form>
                <?php } ?>
            <?php } else { ?>
                <div class="col-12">
                    <p class="icon-big"><i class="fas fa-tasks"></i></p><p>Por enquanto, não temos dados suficientes para recomendar itens a você.<br></p><br>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>