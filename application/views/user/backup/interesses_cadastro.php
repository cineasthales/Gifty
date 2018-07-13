<div class="col-12">
    <h2>Seus Interesses</h2>
    <small>Marque quantas opções quiser. Isto ajudará nosso sistema
        a recomendar itens mais adequados para você.
        <a href="<?= base_url('sobre') ?>" target="_blank">Saiba mais</a></small><br><br>
</div>
<div class="col-4">
    <?php
    $tam = count($categorias);
    for ($i = 0; $i < $tam / 3; $i++) {
        ?>
        <label for="<?= 'categoria_' . $categorias[$i]->id ?>">
            <input type="checkbox" id="<?= 'categoria_' . $categorias[$i]->id ?>" 
                   name="<?= 'categoria_' . $categorias[$i]->id ?>"> <?= $categorias[$i]->descricao ?>
        </label><br> 
    <?php } ?>
</div>
<div class="col-4">
    <?php for ($i = $tam / 3; $i < $tam * (2 / 3); $i++) { ?>
        <label for="<?= 'categoria_' . $categorias[$i]->id ?>">
            <input type="checkbox" id="<?= 'categoria_' . $categorias[$i]->id ?>" 
                   name="<?= 'categoria_' . $categorias[$i]->id ?>"> <?= $categorias[$i]->descricao ?>
        </label><br> 
    <?php } ?>
</div>
<div class="col-4">
    <?php for ($i = $tam * (2 / 3); $i < $tam; $i++) { ?>
        <label for="<?= 'categoria_' . $categorias[$i]->id ?>">
            <input type="checkbox" id="<?= 'categoria_' . $categorias[$i]->id ?>" 
                   name="<?= 'categoria_' . $categorias[$i]->id ?>"> <?= $categorias[$i]->descricao ?>
        </label><br> 
    <?php } ?> 
</div>
