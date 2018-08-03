<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Criar Lista</h1>
            </div>
            <form method="post" action="<?= base_url('usuario/criar/lista') ?>">
                <div class="col-12">
                    <h2>Etapa 2 de 3: escolha os amigos que você convidará! (:</h2><br>
                </div>
                <?php if (count($amizades) > 0) { ?>
                    <?php foreach ($amizades as $amizade) { ?>
                        <div class="col-2">
                            <?php if ($this->session->id == $amizade->idUsuario1) { ?>
                                <label><img style="width: 100%; height: 9em" src="<?= base_url('assets/img/profiles/') . $amizade->idUsuario2 . '.jpg' ?>"><br>
                                    <p><input type="checkbox" id="<?= $amizade->idUsuario2 ?>" name="<?= $amizade->idUsuario2 ?>"> <?= $amizade->nome2 ?> <?= $amizade->snome2 ?></p></label><br><br>
                            <?php } else { ?>
                                <label><img style="width: 100%; height: 9em" src="<?= base_url('assets/img/profiles/') . $amizade->idUsuario1 . '.jpg' ?>"><br>
                                    <p><input type="checkbox" id="<?= $amizade->idUsuario1 ?>" name="<?= $amizade->idUsuario1 ?>"> <?= $amizade->nome1 ?> <?= $amizade->snome1 ?></p></label><br><br>
                            <?php } ?>                            
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="col-12">
                        <p class="icon-big"><i class="fas fa-users"></i></p><p>Você ainda não tem amigos.<br></p><br>
                    </div>
                <?php } ?>
                <div class="col-12">
                    <br>
                    <input type="submit" value="Avançar"><br>
                </div>
            </form>            
        </div>
    </section>    
</main>