<script src="<?= base_url('assets/js/ajax.js') ?>"></script>
<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Nova Lista</h1>
            </div>
            <form method="post" action="<?= base_url('usuario/criar/finalizar') ?>">
                <div class="col-12">
                    <br><h2>Etapa 3 de 3: Lista de Presentes</h2>
                </div>
                <div class="col-12">
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
                                <td><?= $item->dataAdicao ?></td>
                                <td>Subir | Descer | Apagar</td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="col-12">
                    <br>
                    <input type="submit" value="Finalizar"><br>
                </div>
            </form>            
        </div>
    </section>    
</main>