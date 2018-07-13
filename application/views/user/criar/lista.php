<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Criar Lista</h1>
            </div>
            <div class="col-10">
                <br><h2>Etapa 3 de 3: adicione os itens na sua lista de presentes! (:</h2>
            </div>
            <div class="col-2">
                <br><a href="<?= base_url('usuario/criar/finalizar') ?>">Finalizar</a>
            </div>
            <div class="col-12">
                <?php if (count($itens) > 0) { ?>
                    <br><br><table>
                        <tr>
                            <th>Posição</th>
                            <th>Item</th>
                            <th>Adicionado em</th>
                            <th>Ações</th>
                        </tr>
                        <?php for ($i = 0; $i < count($itens); ++$i) { ?>
                            <tr>
                                <td><?= $itens[$i]->prioridade ?></td>
                                <td><?= $itens[$i]->nome ?></td>
                                <td><?= date_format(date_create($itens[$i]->dataAdicao), 'd/m/Y') ?></td>
                                <td>
                                    <?php if (count($itens) > 1) { ?>
                                        <?php if ($i > 0) { ?>
                                            <a href="<?= base_url('usuario/criar/subir/') . $itens[$i]->idItem ?>"><i class="fas fa-chevron-circle-up"></i></a>
                                        <?php } ?>                                            
                                        <?php if ($i < count($itens) - 1) { ?>
                                            <a href="<?= base_url('usuario/criar/descer/') . $itens[$i]->idItem ?>"><i class="fas fa-chevron-circle-down"></i></i></a>
                                        <?php } ?>
                                    <?php } ?>
                                    <a href="<?= base_url('usuario/criar/apagar/') . $itens[$i]->idItem ?>"><i class="fas fa-minus-circle"></i></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table><br><br>
                <?php } else { ?>
                    <br><br><p>Sua lista está vazia!</p><br><br>
                <?php } ?>
            </div>               
            <div class="col-5">
                <h2>Itens Sugeridos</h2>
            </div>
            <form method="post" action="<?= base_url('usuario/criar/busca') ?>">
                <div class="col-6">                    
                    <input type="text" id="busca" name="busca" pattern="[A-Za-z0-9]{,100}" 
                           maxlength="100" required placeholder="Buscar itens">
                </div>
                <div class="col-1">
                    <button id='btsearch' type="submit"><i class="fas fa-search"></i></button><br><br>
                </div>
            </form>       
            <div class="col-4">
                <p><strong>Produto</strong></p>
            </div>          
            <div class="col-2">
                <p><strong>Preço</strong></p>
            </div>
            <div class="col-4">
                <p><strong>Imagem</strong></p>
            </div>
            <div class="col-2">
            </div>
            <div class="col-12">
                <br>
            </div>
            <?php
            foreach ($json->results as $item) {
                $item->title = str_replace('%20', ' ', $item->title);
                $item->title = preg_replace('/[^A-Za-z0-9\ ]/', ' ', $item->title);
                ?>
                <form method="post" action="<?= base_url('usuario/criar/adicionar') ?>">
                    <div class="col-4">
                        <p><a href="<?= $item->permalink ?>" target='_blank'><?= $item->title ?></a></p>
                        <input hidden type="text" id="nome" name="nome" value="<?= $item->title ?>">
                        <input hidden type="text" id="url" name="url" value="<?= $item->permalink ?>">
                        <input hidden type="text" id="descricao" name="descricao" value="-">
                        <input hidden type="text" id="idCategoria" name="idCategoria" value="<?= $item->category_id ?>">
                    </div>
                    <div class="col-2">
                        <p>R$ <?= number_format($item->price, 2, ',', '.') ?></p>
                        <input hidden type="text" id="preco" name="preco" value="<?= $item->price ?>">
                    </div>
                    <div class="col-4">
                        <p><img src="<?= $item->thumbnail ?>"></p>
                        <input hidden type="text" id="imagem" name="imagem" value="<?= $item->thumbnail ?>">
                    </div>
                    <div class="col-2">
                        <input type="submit" value="Adicionar">
                    </div>
                </form>
            <?php } ?>
        </div>
    </section>    
</main>