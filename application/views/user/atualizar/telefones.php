<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Gerenciar Telefones</h1><br>
            </div>
            <div class="col-6">
                <h2>Adicionar Telefone</h2><br>
            </div>
            <div class="col-6">
                <h2>Seus Telefones</h2><br>
            </div>
            <form method="post" action="<?= base_url('usuario/configuracoes/grava_telefone') ?>">                
                <div class="col-1">
                    <label for="numero">DDD</label><br>
                    <input type="text" id="ddd" name="ddd" required
                           pattern="[0-9]{,3}" maxlength="3"><br><br>
                </div>
                <div class="col-3">
                    <label for="numero">Número</label><br>
                    <input type="text" id="numero" name="numero" required
                           pattern="[0-9]{,9}" maxlength="9"><br><br>
                </div>
                <div class="col-2">
                    <button type="submit"><i class="fas fa-plus"></i></button>
                </div>
            </form>            
            <?php foreach ($telefones as $telefone) { ?>
                <div class="col-5">
                    (<?= $telefone->ddd ?>)
                    <?php
                    if (strlen($telefone->numero) == 9) {
                        echo substr($telefone->numero, 0, 5) . '-' . substr($telefone->numero, 5);
                    } else {
                        echo substr($telefone->numero, 0, 4) . '-' . substr($telefone->numero, 4);
                    }
                    echo '  ';
                    ?>
                </div>
                <div class="col-1">
                    <button class="btListas"><a href="<?= base_url('usuario/configuracoes/excluir_telefone/' . $telefone->id) ?>"
                                                onclick="return confirm('Tem certeza que deseja excluir este telefone?')">
                            <i class="fas fa-times"></i></a>
                    </button>
                </div>
            <?php } ?>            
        </div>
    </section>
</main>