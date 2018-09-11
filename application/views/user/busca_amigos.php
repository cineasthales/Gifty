<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Amigos</h1>
            </div>
            <div class="col-12">
                <br><h2>Resultados da Busca</h2><br>
            </div>
            <?php foreach ($usuarios as $usuario) { ?>
                <form method="post" action="<?= base_url('usuario/amigos/adicionar') ?>">
                    <div class="col-3">
                        <a href="<?= base_url('usuario/amigos/perfil/') . $usuario->id ?>">
                           <img style="width: 100%; height: 13em" src="<?= base_url('assets/img/profiles/') . $usuario->id . '.jpg' ?>">
                            <p><?= $usuario->nome ?> <?= $usuario->sobrenome ?></p></a>                     
                        <input hidden type="text" id="idUsuario2" name="idUsuario2" value="<?= $usuario->id ?>">           
                        <br><input type="submit" class="btListas" value="Adicionar"><br><br>
                    </div>
                </form>
            <?php } ?>
        </div>
    </section>    
</main>