<main>
    <section>
        <div class="row"> 
            <div class="col-3">
                <h1>Listas</h1>
            </div>
            <div class="col-9">
                <button id="btCriarLista"><a href="<?= base_url('usuario/nova_lista') ?>">Nova Lista</a></button>
            </div>
            <div class="col-12">
                <h2>Minhas Listas</h2>                
            </div>
            <?php if (count($eventos) > 0) { ?>
                <table>
                    <tr>
                        <th>Evento</th>
                        <th>Ações</th>
                    </tr>
                    <?php foreach ($eventos as $evento) { ?>
                        <tr>
                            <td><?= $evento->titulo ?> - <?= date_format(date_create($evento->data), 'd/m/Y') ?> - <?= substr($evento->hora, 0, 5) ?></td>
                            <td>Alterar Evento | Lista de Convidados | Lista de Presentes</td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <p>Você ainda não criou listas!</p>
            <?php } ?>
            <div class="col-12">
                <br><h2>Convites para mim</h2>
            </div>
            <?php if (count($convidados) > 0) { ?>
                <table>
                    <tr>
                        <th>Evento</th>
                        <th>Ações</th>
                    </tr>  
                    <?php foreach ($convidados as $convidado) { ?>
                        <tr>
                            <td><?= $convidado->evento ?> - <?= date_format(date_create($convidado->data), 'd/m/Y') ?> - <?= substr($convidado->hora, 0, 5) ?></td>
                            <td>Alterar Evento | Lista de Convidados | Lista de Presentes</td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <p>Você não tem nenhum convite!</p>
            <?php } ?>
        </div>
    </section>    
</main>