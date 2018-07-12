<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Criar Lista</h1>
            </div>
            <form method="post" action="<?= base_url('usuario/criar/finalizar') ?>">
                <div class="col-10">
                    <br><h2>Etapa 3 de 3: adicione os itens na sua lista de presentes! (:</h2>
                </div>
                <div class="col-2">
                    <br>
                    <input type="submit" value="Finalizar"><br>
                </div>
                <div class="col-12">
                    <?php if ($itens != NULL) { ?>
                        <table>
                            <tr>
                                <th>Posição</th>
                                <th>Item</th>
                                <th>Adicionado em</th>
                                <th>Ações</th>
                            </tr>
                            <?php foreach ($itens as $item) { ?>
                                <tr>
                                    <td><?= $item->prioridade ?></td>
                                    <td><?= $item->nome ?></td>
                                    <td><?= date_format(date_create($usuario->dataAdicao), 'd/m/Y') ?></td>
                                    <td>Subir | Descer | Apagar</td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php } else { ?>
                    <p>Sua lista está vazia!</p><br><br>
                    <?php } ?>
                </div>                
            </form>            
            <div class="col-4">
                <h2>Itens Sugeridos</h2>
            </div>
            <form method="post" action="<?= base_url('usuario/criar/busca') ?>">
                <div class="col-6">                    
                    <input type="text" id="busca" name="busca" pattern="[A-Za-z0-9]{,100}" 
                           maxlength="100" required>
                </div>
                <div class="col-2">
                    <button id='btsearch' type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="col-12">
                <p>Aqui vão as recomendações!</p>
            </div>
        </div>
    </section>    
</main>