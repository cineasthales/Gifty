<main>
    <section>
        <div class="row"> 
            <div class="col-3">
                <h1>Listas</h1>
            </div>
            <div class="col-9">
                <button id="btCriarLista"><a href="<?= base_url('usuario/criar') ?>">Criar Lista</a></button>
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
                            <td>
                                <a href="#"><i class="fas fa-info-circle"></i> Ver Detalhes</a><br>
                                <a href="#"><i class="fas fa-gift"></i> Atualizar Lista de Presentes</a><br>
                                <a href="#"><i class="far fa-id-card"></i> Atualizar Convidados</a><br>
                                <a href="#"><i class="fas fa-calendar-alt"></i> Atualizar Evento</a><br>
                                <a href="#"><i class="fas fa-times"></i> Cancelar Evento e Lista</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <div class="col-12">
                    <br><p class="icon-big"><i class="fas fa-exclamation-triangle"></i></p><p>Você não tem listas ativas! Que tal <a href="<?= base_url('usuario/criar') ?>">criar uma</a>?</p><br>
                </div>
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
                            <td>
                                <a href="#"><i class="fas fa-info-circle"></i> Ver Detalhes</a><br>
                                <?php if ($convidado->comparecera) { ?>
                                    <a href="#"><i class="fas fa-user-times"></i> Desconfirmar Presença</a>
                                <?php } else { ?>
                                    <a href="#"><i class="fas fa-user-plus"></i> Confirmar Presença</a><br>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <div class="col-12">
                    <br><p><span class="icon-small"><i class="fas fa-exclamation-triangle"></i></span>
                        Você não tem nenhum convite no momento!
                        <span class="icon-small"><i class="fas fa-exclamation-triangle"></i></span></p><br>     
                </div>                
            <?php } ?>
        </div>
    </section>    
</main>