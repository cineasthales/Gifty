<?php
if ($this->session->has_userdata('mensagem')) {
    $mensagem = $this->session->flashdata('mensagem');
    $tipo = $this->session->flashdata('tipo');
    if ($tipo) {
        ?>
        <section class="alerta_sucesso">
            <div class="row">
                <div class="col-11">
                    <small><strong>Sucesso!</strong> <?= $mensagem ?></small>
                </div>
                <div class="col-1">
                    <small id="xis"><a href="#">X</a></small>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <section class="alerta_erro">
            <div class="row">
                <div class="col-11">
                    <small><strong>Erro.</strong> <?= $mensagem ?></small>
                </div>
                <div class="col-1">
                    <small id="xis"><a href="#">X</a></small>
                </div>
            </div>
        </section>
        <?php
    }
}
?>
<main>
    <section>
        <div class="row">
            <div class="col-12">
                <h1>Listas de presentes personalizadas</h1>
                <p>Organize seu evento, monte sua lista e convide seus amigos. Tudo gratuitamente. </p><br>
                <button><a href="<?= base_url('home/cadastrar') ?>">Cadastre-se</a></button>
            </div>
        </div>
    </section>
    <section class="fundoAlt">
        <div class="row">
            <div class="col-12">
                <h1>Nunca mais erre o presente</h1>
                <p>Gifty foi projetado para que você saiba exatamente que presentes
                    escolher, sem riscos de constrangimentos ou de repetições.</p>
            </div>       
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-12">
                <h1>O que você vai ganhar ainda será um segredo</h1>
                <p>Os seus convidados marcam os itens comprados, mas você não fica
                    sabendo quem comprou e o que foi comprado.</p>
            </div>
        </div>
    </section>
    <section class="fundoAlt">
        <div class="row">
            <div class="col-12">
                <h1>Sem mais listas em lojas específicas</h1>
                <p>Não importa se for casamento, formatura, aniversário ou qualquer
                    outro evento particular. Você e seus convidados não precisam mais ficar
                    sujeitos às opções de uma mesma loja.</p>
            </div>
        </div>
    </section>
</main>