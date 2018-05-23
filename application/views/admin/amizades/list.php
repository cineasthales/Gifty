<?php
if ($this->session->has_userdata('mensagem')) {
    $mensagem = $this->session->flashdata('mensagem');
    $tipo = $this->session->flashdata('tipo');
    if ($tipo) {
        ?>
        <section class="alerta_sucesso">
            <div class="row-plus">
                <div class="col-12">
                    <small><strong>Sucesso!</strong> <?= $mensagem ?></small>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <section class="alerta_erro">
            <div class="row-plus">
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
        <div class="row-plus"> 
            <div class="col-3">
                <h1>Amizades</h1>
            </div>
            <form method="post" action="<?= base_url('admin/amizades/buscar') ?>">
                <div class="col-3">
                    <label for="filtro" hidden>Filtro</label>
                    <select id="filtro" name="filtro">
                        <option value="0">------</option>
                        <option value="1">Usuário</option>
                        <option value="2">Data</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="busca" hidden>Buscar</label>
                    <input type="search" id="busca" name="busca">
                </div>                
                <div class="col-1">
                    <button id='btsearch' type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="col-1">
                <button class='bt'><a href="<?= base_url('admin/amizades/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <?php if (count($amizades) > 1) { ?>
                    <small><strong><?= count($amizades) ?> registros encontrados.</strong></small>
                <?php } else if (count($amizades) == 1) { ?>
                    <small><strong><?= count($amizades) ?> registro encontrado.</strong></small>
                <?php } else { ?>
                    <small><strong>Nenhum registro encontrado.</strong></small>
                <?php } ?>              
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($amizades as $amizade) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-11">
                    <strong><?= $amizade->nome1 ?> <?= $amizade->snome1 ?> (# <?= $amizade->idUsuario1 ?>)</strong>
                    é amigo(a) de <strong><?= $amizade->nome2 ?> <?= $amizade->snome2 ?> (# <?= $amizade->idUsuario2 ?>)</strong>
                    desde <?= date_format(date_create($amizade->dataAmizade), 'd/m/Y') ?>
                </div>
                <div class="col-1">
                    <button class='bt'><a href="<?=
                        base_url('admin/amizades/excluir/' . $amizade->idUsuario1 . '/'
                                . $amizade->idUsuario2)
                        ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir esta amizade?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                </div>
                <div class="col-2">
                    <?php if ($amizade->ativa) { ?>
                        <strong><span style='color: #339900'>ATIVA</span></strong>
                    <?php } else { ?>
                        <strong><span style='color: red'>INATIVA</span></strong>
                    <?php } ?>
                </div>
                <div class="col-10">
                    <?php if ($amizade->bloqueado1 && $amizade->bloqueado2) { ?>
                        Ambos os usuários bloquearam o outro.
                    <?php } else if ($amizade->bloqueado1) { ?>
                        <?= $amizade->nome2 ?> <?= $amizade->snome2 ?> bloqueou <?= $amizade->nome1 ?> <?= $amizade->snome1 ?>.
                    <?php } else if ($amizade->bloqueado2) { ?>
                        <?= $amizade->nome1 ?> <?= $amizade->snome1 ?> bloqueou <?= $amizade->nome2 ?> <?= $amizade->snome2 ?>.
                    <?php } ?>
                </div>
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>