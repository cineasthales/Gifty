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
    <section class="fundo1">
        <div class="row">
            <div class="col-12">
                <h1>LISTAS DE PRESENTES<br>PERSONALIZADAS</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>Organize seu evento<br>
                    Monte sua lista de presentes<br>
                    Convide seus amigos<br><br>
                    Tudo gratuitamente</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button id="btCadastrar"><a href="<?= base_url('home/cadastrar') ?>">Cadastre-se</a></button>
            </div>
        </div>
    </section>
    <section class="fundo2">
        <div class="row">
            <div class="col-12">
                <h1 style="text-align: center">POR QUE USAR O GIFTY?</h1><br><br><br>
            </div>             
            <div class="col-6">
                <h2 class="homeh"><i class="fas fa-gift"></i><br><br>Nunca mais erre o presente</h2><br>
                <p>Gifty foi projetado para que você saiba exatamente que presentes
                    escolher. Sem constrangimentos, sem repetições.</p>
            </div>
            <div class="col-6">
                <h2 class="homeh"><i class="fas fa-user-secret"></i><br><br>O que você ganhar ainda será um segredo</h2><br>
                <p>Os seus convidados marcam os itens comprados, mas você não fica
                    sabendo quem comprou e o que foi comprado.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h2 class="homeh"><i class="fas fa-search"></i><br><br>Pesquise e economize</h2><br>
                <p>Você e seus convidados não precisam mais ficar
                    sujeitos às opções e aos preços de uma mesma loja.</p>
            </div>
            <div class="col-6">
                <h2 class="homeh"><i class="fas fa-calendar-check"></i><br><br>Para qualquer ocasião particular</h2><br>
                <p>Utilize o Gifty para casamentos, formaturas, aniversários ou quaisquer
                    outros eventos particulares.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button id="btSaibaMais"><a href="<?= base_url('sobre') ?>">Saiba mais</a></button>
            </div>
        </div>
    </section>
    <section class="fundo3">
        <div class="row">
            <div class="col-12">
                <h1 class="footerh">
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </h1>
            </div>
        </div>
    </section>
</main>