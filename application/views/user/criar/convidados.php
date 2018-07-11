<script src="<?= base_url('assets/js/ajax.js') ?>"></script>
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
                <?php foreach ($amizades as $amizade) { ?>
                    <div class="col-2">
                        <?php if ($this->session->id == $amizade->idUsuario1) { ?>
                            <label><img style="width: 100%; height: 9em" src="<?= base_url('assets/img/profiles/') . $amizade->idUsuario2 . '.jpg' ?>"><br>
                                <p><?= $amizade->nome2 ?> <?= $amizade->snome2 ?></p>
                                <input type="checkbox" value="<?= $amizade->idUsuario2 ?>">Convidar</label><br><br>
                        <?php } else { ?>
                            <label><img style="width: 100%; height: 9em" src="<?= base_url('assets/img/profiles/') . $amizade->idUsuario1 . '.jpg' ?>"><br>
                                <p><?= $amizade->nome1 ?> <?= $amizade->snome1 ?></p>
                                <input type="checkbox" value="<?= $amizade->idUsuario1 ?>">Convidar</label><br><br>
                        <?php } ?>                            
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