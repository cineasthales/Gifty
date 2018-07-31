<footer>
    <div class="row">
        <div class="col-6">
            <br>
            <ul>
                <li><small><a href="<?= base_url() ?>">Página Inicial</a></small></li><br>
                <li><small><a href="<?= base_url('gifty/sobre') ?>">Sobre</a></small></li><br>
                <li><small><a href="<?= base_url('gifty/novidades') ?>">Novidades</a></small></li><br>
                <li><small><a href="<?= base_url('gifty/quemsomos') ?>">Quem Somos</a></small></li><br>
                <li><small><a href="<?= base_url('gifty/contato') ?>">Contato</a></small></li>   
            </ul>
        </div>
        <div class="col-6">
            <small>Publicidade</small><br>
            <a href="<?= base_url('usuario/inicio/cliqueanuncio/' . $anuncio->id) ?>">
                <img src="<?= base_url('assets/img/misc/' . $anuncio->imagem) ?>" alt="Publicidade" id="ad">
            </a>
        </div>
    </div>
</footer>
</body>
</html>