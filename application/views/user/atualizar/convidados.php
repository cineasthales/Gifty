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
            <div class="col-8">
                <h1>Atualizar Convidados</h1>
            </div>
            <div class="col-4">
                <button id="btFinalizar">
                    <a href="<?= base_url('usuario/criar/finalizar') ?>">Finalizar</a></button>
            </div>
            <?php if (count($convidados) > 0) { ?>
                <div class="col-12">
                    <br><h2>Convidados</h2>
                </div>
                <?php foreach ($convidados as $convidado) { ?>
                    <div class="col-2">
                        <img style="width: 100%; height: 9em" src="<?= base_url('assets/img/profiles/') . $convidado->imagem ?>"><br>
                        <p><?= $convidado->nome ?> <?= $convidado->snome ?></p>
                        <br><button class="btListas"><a href="<?= base_url('usuario/atualizar/desfazer_convite/') . $idEvento . '/' . $convidado->idUsuario ?>" onclick="return confirm('Tem certeza que deseja desfazer o convite de <?= $convidado->nome ?> <?= $convidado->snome ?>?')">
                                <i class="fas fa-user-times"></i> Desfazer Convite</a></button>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="col-12">
                    <br><h2>Convidados</h2>
                </div>
                <div class="col-12">
                    <p class="icon-big"><i class="fas fa-users"></i></p><p>Você ainda não tem convidados.<br></p><br>
                </div>
            <?php } ?>
            <?php if (isset($amizades)) { ?> 
                <?php if (count($convidados) < count($amizades)) { ?> 
                    <div class="col-12">
                        <br><br><h2>Outros Amigos</h2>
                    </div>
                    <?php
                    $mostra = true;
                    foreach ($amizades as $amizade) {
                        foreach ($convidados as $convidado) {
                            if (($convidado->idUsuario == $amizade->idUsuario1) || ($convidado->idUsuario == $amizade->idUsuario2)) {
                                $mostra = false;
                                break;
                            }
                        }
                        if ($mostra) {
                            if ($this->session->id == $amizade->idUsuario1) {
                                ?>
                                <div class="col-2">
                                    <img style="width: 100%; height: 9em" src="<?= base_url('assets/img/profiles/') . $amizade->imagem2 ?>"><br>
                                    <p><?= $amizade->nome2 ?> <?= $amizade->snome2 ?></p>
                                    <br><button class="btListas"><a onclick="return confirm('Convidar <?= $amizade->nome2 ?> <?= $amizade->snome2 ?>?')" href="<?= base_url('usuario/atualizar/convidar/') . $idEvento . '/' . $amizade->idUsuario2 ?>">
                                            <i class="fas fa-user-plus"></i> Convidar</a></button>
                                </div>
                            <?php } else { ?>
                                <div class="col-2">
                                    <img style="width: 100%; height: 9em" src="<?= base_url('assets/img/profiles/') . $amizade->imagem1 ?>"><br>
                                    <p><?= $amizade->nome1 ?> <?= $amizade->snome1 ?></p>
                                    <br><button class="btListas"><a onclick="return confirm('Convidar <?= $amizade->nome1 ?> <?= $amizade->snome1 ?>?')" href="<?= base_url('usuario/atualizar/convidar/') . $idEvento . '/' . $amizade->idUsuario1 ?>">
                                            <i class="fas fa-user-plus"></i> Convidar</a></button>
                                </div>
                                <?php
                            }
                        }
                        $mostra = true;
                    }
                    ?>
                <?php } ?>
            <?php } else { ?>
                <div class="col-12">
                    <p class="icon-big"><i class="fas fa-users"></i></p><p>Você ainda não tem amigos.<br></p><br>
                </div>
            <?php } ?>
            <form method="post" action="<?= base_url('usuario/atualizar/convidar_email') ?>">
                <div class="col-12">
                    <br><br><h2>Enviar convite por e-mail</h2>
                    <small>Para aquele(a) amigo(a) que ainda não está no Gifty! :)</small>
                </div>                             
                <div class="col-6">                    
                    <br><input type="email" id="email" name="email" placeholder="exemplo@exemplo.com" required>
                    <input type="text" id="idEvento" name="idEvento" hidden value="<?= $idEvento ?>">                   
                </div>
                <div class="col-2">
                    <br><button style="font-size:0.8em" class="btListas" type="submit"><i class="fas fa-envelope"></i> Enviar</button>
                </div>
            </form>             
        </div>
    </section>
</main>
