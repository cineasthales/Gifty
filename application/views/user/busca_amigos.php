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
                    <button id='btsearch' style="font-size: 0.75em;" type="submit"><i class="fas fa-search"></i></button><br>
                </div>
            </form>
            <div class="col-12">
                <?php if (count($usuarios) > 0) { ?>
                    <?php if (count($usuarios) > 1) { ?>
                        <h2>A busca ' <?= $busca ?> ' retornou <?= count($usuarios) ?> resultados.</h2><br>
                    <?php } else if (count($usuarios) == 1) { ?>
                        <h2>A busca ' <?= $busca ?> ' retornou 1 resultado.</h2><br>
                    <?php } ?>
                    <?php foreach ($usuarios as $usuario) { ?>
                        <div class="col-3">                    
                            <img style="width: 100%; height: 13em" src="<?= base_url('assets/img/profiles/') . $usuario->id . '.jpg' ?>">
                            <p><br><strong><?= $usuario->nome ?> <?= $usuario->sobrenome ?></strong></p>
                            <p><?= $usuario->genero ?></p>
                            <p><?= floor(date('Y') - date_format(date_create($usuario->dataNasc), 'Y')) ?> anos</p>
                            <p><?= $usuario->cidade ?> / <?= $usuario->estado ?></p>
                            <br><button class="btListas"><a href="<?= base_url('usuario/amigos/adicionar/') . $usuario->id ?>">
                                    <i class="fas fa-user-plus"></i> Solicitar Amizade</a></button>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <h2>A busca ' <?= $busca ?> ' não retornou resultados.</h2><br>
                <?php } ?>         
            </div>            
        </div>
    </section>    
</main>