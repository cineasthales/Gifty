<main>
    <section>
        <div class="row"> 
            <div class="col-6">
                <h1>Amigos</h1>
            </div>
            <form method="post" action="<?= base_url('usuario/amigos/busca') ?>">
                <div class="col-5">
                    <br>                    
                    <input type="text" id="busca" name="busca" pattern="[A-Za-z0-9]{,100}" 
                           maxlength="100" required placeholder="Buscar novos amigos">
                </div>
                <div class="col-1">
                    <br>
                    <button id='btsearch' type="submit"><i class="fas fa-search"></i></button><br><br>
                </div>
            </form>
            <?php if (count($amizades) > 0) { ?>
                <?php foreach ($amizades as $amizade) { ?>
                    <div class="col-2">
                        <?php if ($this->session->id == $amizade->idUsuario1) { ?>
                            <a href="<?= base_url('usuario/amigos/perfil/') . $amizade->idUsuario2?>"><img style="width: 100%; height: 9em" src="<?= base_url('assets/img/profiles/') . $amizade->idUsuario2 . '.jpg' ?>"><br>
                                <p><?= $amizade->nome2 ?> <?= $amizade->snome2 ?></p></a>
                            <br><button class="btBloq"><a href="<?= base_url('usuario/amigos') ?>" onclick="return confirm('Tem certeza que deseja bloquear <?= $amizade->nome2 ?> <?= $amizade->snome2 ?>?')">
                                    <i class="fas fa-user-slash"></i></a></button>
                            <button class="btExc"><a href="<?= base_url('usuario/amigos') ?>" onclick="return confirm('Tem certeza que deseja excluir <?= $amizade->nome2 ?> <?= $amizade->snome2 ?>?')">
                                    <i class="fas fa-user-times"></i></a></button>
                            <br><br>
                        <?php } else { ?>
                            <a href="<?= base_url('usuario/amigos/perfil/') . $amizade->idUsuario1?>"><img style="width: 100%; height: 9em" src="<?= base_url('assets/img/profiles/') . $amizade->idUsuario1 . '.jpg' ?>"><br>
                                <p><?= $amizade->nome1 ?> <?= $amizade->snome1 ?></p></a>
                            <br><button class="btBloq"><a href="<?= base_url('usuario/amigos') ?>" onclick="return confirm('Tem certeza que deseja bloquear <?= $amizade->nome1 ?> <?= $amizade->snome1 ?>?')">
                                    <i class="fas fa-user-slash"></i></a></button>
                            <button class="btExc"><a href="<?= base_url('usuario/amigos') ?>" onclick="return confirm('Tem certeza que deseja excluir <?= $amizade->nome1 ?> <?= $amizade->snome1 ?>?')">
                                    <i class="fas fa-user-times"></i></a></button>
                            <br><br>
                        <?php } ?>                            
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="col-12">
                    <p class="icon-big"><i class="fas fa-users"></i></p><p>Você ainda não tem amigos.<br></p><br>
                </div>
            <?php } ?>
        </div>
    </section>    
</main>