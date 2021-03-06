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
                <h1>Convidados</h1>
            </div>
            <form method="post" action="<?= base_url('admin/convidados') ?>">
                <div class="col-3">
                    <label for="filtro" hidden>Filtro</label>
                    <select id="filtro" name="filtro">
                        <option value="0">------</option>
                        <option value="1">Evento</option>
                        <option value="2">Usuário</option>                      
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
                <button class='bt'><a href="<?= base_url('admin/convidados/adicionar/') ?>"><i class="fas fa-plus"></i></a></button>
            </div>
            <div class="col-12">
                <?php if (count($convidados) > 1) { ?>
                    <small><strong><?= count($convidados) ?> registros encontrados.</strong></small>
                <?php } else if (count($convidados) == 1) { ?>
                    <small><strong><?= count($convidados) ?> registro encontrado.</strong></small>
                <?php } else { ?>
                    <small><strong>Nenhum registro encontrado.</strong></small>
                <?php } ?>              
            </div>
            <div class="col-12">
                <hr>
            </div>
            <?php
            foreach ($convidados as $convidado) {
                ?>
                <div class="col-12">
                    <br>
                </div>
                <div class="col-10">
                    O evento <strong><?= $convidado->evento ?> (# <?= $convidado->idEvento ?>)</strong>
                    tem o convidado <strong><?= $convidado->nome ?> <?= $convidado->snome ?>
                        (# <?= $convidado->idUsuario ?>)</strong>
                </div>
                <div class="col-2">
                    <button class='bt' id="btdel"><a href="<?=
                        base_url('admin/convidados/excluir/' . $convidado->idUsuario . '/'
                                . $convidado->idEvento)
                        ?>"
                                          onclick="return confirm('Tem certeza que deseja excluir este convidado?')">
                            <i class="fas fa-trash-alt"></i></a></button>
                    <button class='bt'><a href="<?=
                        base_url('admin/convidados/atualizar/' . $convidado->idUsuario . '/'
                                . $convidado->idEvento)
                        ?>">
                            <i class="fas fa-edit"></i></a></button>
                </div>
                <div class="col-3">
                    <?php if (!$convidado->bloqueado) { ?>
                        <strong><span style='color: #339900'>ATIVO</span></strong>
                    <?php } else { ?>
                        <strong><span style='color: red'>CONVITE DESFEITO</span></strong>
                    <?php } ?>
                </div>                
                <div class="col-4">
                    <?php if ($convidado->comparecera) { ?>
                        Marcou comparecimento
                    <?php } else { ?>
                        Não marcou comparecimento
                    <?php } ?>
                </div>
                <div class="col-5">
                    <?php
                    if ($convidado->comparecera && date("Y-m-d") > $convidado->data) {
                        if ($convidado->compareceu) {
                            ?>
                            Compareceu
                        <?php } else { ?>
                            Não compareceu
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="col-12">
                    <br><hr>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>