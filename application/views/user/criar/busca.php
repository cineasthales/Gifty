<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Criar Lista</h1>
            </div>
            <div class="col-12">
                <br><h2>Resultados da Busca</h2>
            </div>          
            <div class="col-4">
                <p>Produto</p>
            </div>          
            <div class="col-2">
                <p>Preço</p>
            </div>
            <div class="col-4">
                <p>Imagem</p>
            </div>
            <div class="col-2">
                <p>Adicionar</p>
            </div>
            <?php
            foreach ($json->results as $item) {
                $item->title = str_replace('%20', ' ', $item->title);
                $item->title = preg_replace('/[^A-Za-z0-9\ ]/', ' ', $item->title);
                ?>
                <form method="post" action="<?= base_url('usuario/criar/adicionar') ?>">
                    <div class="col-4">
                        <p><a href="<?= $item->permalink ?>" target='_blank'><?= $item->title ?></a></p>
                        <input hidden type="text" id="nome" name="nome" value="<?= $item->title ?>">
                        <input hidden type="text" id="url" name="url" value="<?= $item->permalink ?>">
                        <input hidden type="text" id="descricao" name="descricao" value="-">
                        <input hidden type="text" id="idCategoria" name="idCategoria" value="1">
                    </div>
                    <div class="col-2">
                        <p>R$ <?= number_format($item->price, 2, ',', '.') ?></p>
                        <input hidden type="text" id="preco" name="preco" value="<?= $item->price ?>">
                    </div>
                    <div class="col-4">
                        <p><img src="<?= $item->thumbnail ?>"></p>
                        <input hidden type="text" id="imagem" name="imagem" value="<?= $item->thumbnail ?>">
                    </div>
                    <div class="col-2">
                        <input type="submit" value="Adicionar">
                    </div>
                </form>
            <?php } ?>
        </div>
    </section>    
</main>