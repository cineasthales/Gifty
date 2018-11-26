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
            <div class="col-6">
                <h1>Amigos</h1>
            </div>
            <form method="post" action="<?= base_url('usuario/amigos/buscar') ?>">
                <div class="col-5">
                    <br>                    
                    <input type="text" id="busca" name="busca" pattern="[A-Za-z0-9]{,100}" 
                           maxlength="100" required placeholder="Buscar novos amigos">
                </div>
                <div class="col-1">
                    <br>
                    <button id='btsearch' style="font-size: 0.75em;" type="submit"><i class="fas fa-search"></i></button><br><br>
                </div>
            </form>
            <?php if (count($amizades) > 0) { ?>
                <?php foreach ($amizades as $amizade) { ?>
                    <?php if ($amizade->ativa == 1) { ?>
                        <div class="col-3">
                            <?php if ($this->session->id == $amizade->idUsuario1) { ?>
                                <a href="<?= base_url('usuario/amigos/perfil/') . $amizade->idUsuario2 ?>"><img style="width: 100%; height: 13em" src="<?= base_url('assets/img/profiles/') . $amizade->imagem2 ?>"><br>
                                    <p style="font-size: 1.2em; font-weight: bold"><?= $amizade->nome2 ?><br><?= $amizade->snome2 ?></p></a>
                                <?php if ($amizade->bloqueado2) { ?>
                                    <br><button class="btListas"><a href="<?= base_url('usuario/amigos/desbloquear/') . $amizade->idUsuario2 ?>" onclick="return confirm('Desbloquear <?= $amizade->nome2 ?> <?= $amizade->snome2 ?>?')">
                                            <i class="fas fa-user-check"></i> Desbloquear</a></button>
                                <?php } else { ?>
                                    <br><button class="btListas"><a href="<?= base_url('usuario/amigos/bloquear/') . $amizade->idUsuario2 ?>" onclick="return confirm('Tem certeza que deseja bloquear <?= $amizade->nome2 ?> <?= $amizade->snome2 ?>?')">
                                            <i class="fas fa-user-slash"></i> Bloquear</a></button>
                                <?php } ?>  
                                <br><button class="btListas"><a href="<?= base_url('usuario/amigos/desfazer_amizade/') . $amizade->idUsuario2 ?>" onclick="return confirm('Tem certeza que deseja desfazer a amizade com <?= $amizade->nome2 ?> <?= $amizade->snome2 ?>?')">
                                        <i class="fas fa-user-times"></i> Desfazer Amizade</a></button>
                                <br><br>
                            <?php } else { ?>
                                <a href="<?= base_url('usuario/amigos/perfil/') . $amizade->idUsuario1 ?>"><img style="width: 100%; height: 13em" src="<?= base_url('assets/img/profiles/') . $amizade->imagem1 ?>"><br>
                                    <p style="font-size: 1.2em; font-weight: bold"><?= $amizade->nome1 ?><br><?= $amizade->snome1 ?></p></a>
                                <?php if ($amizade->bloqueado1) { ?>
                                    <br><button class="btListas"><a href="<?= base_url('usuario/amigos/desbloquear/') . $amizade->idUsuario1 ?>" onclick="return confirm('Desbloquear <?= $amizade->nome1 ?> <?= $amizade->snome1 ?>?')">
                                            <i class="fas fa-user-check"></i> Desbloquear</a></button>
                                <?php } else { ?>
                                    <br><button class="btListas"><a href="<?= base_url('usuario/amigos/bloquear/') . $amizade->idUsuario1 ?>" onclick="return confirm('Tem certeza que deseja bloquear <?= $amizade->nome1 ?> <?= $amizade->snome1 ?>?')">
                                            <i class="fas fa-user-slash"></i> Bloquear</a></button>
                                <?php } ?> 
                                <br><button class="btListas"><a href="<?= base_url('usuario/amigos/desfazer_amizade/') . $amizade->idUsuario1 ?>" onclick="return confirm('Tem certeza que deseja desfazer a amizade com <?= $amizade->nome1 ?> <?= $amizade->snome1 ?>?')">
                                        <i class="fas fa-user-times"></i> Desfazer Amizade</a></button>
                                <br><br>
                            <?php } ?>                            
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <div class="col-12">
                    <p class="icon-big"><i class="fas fa-users"></i></p><p>Você ainda não tem amigos.<br></p><br>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>