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
                <h1 class="homeh">LISTAS DE PRESENTES PERSONALIZADAS</h1>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-6">
                <p>Organize seu <strong>evento</strong>.<br>
                    Monte sua <strong>lista</strong> de presentes.<br>
                    Convide seus <strong>amigos</strong>.<br><br>
                    <strong>Tudo gratuitamente.</strong></p>
            </div>
            <div class="col-6">
                <button><a href="<?= base_url('home/cadastrar') ?>">Cadastre-se</a></button>
            </div>
        </div>
    </section>
    <section class="fundo2">
        <div class="row">
            <div class="col-6">
                <h2 class="homeh"><i class="fas fa-gift"></i><br>Nunca mais erre o presente</h2>
                <p>Gifty foi projetado para que você saiba exatamente que presentes
                    escolher, sem constrangimentos, nem repetições.</p>
            </div>
            <div class="col-6">
                <h2 class="homeh"><i class="fas fa-user-secret"></i><br>O que você vai ganhar ainda será um segredo</h2>
                <p>Os seus convidados marcam os itens comprados, mas você não fica
                    sabendo quem comprou e o que foi comprado.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h2 class="homeh"><i class="fas fa-search"></i><br>Mais liberdade para pesquisar</h2>
                <p>Você e seus convidados não precisam mais ficar
                    sujeitos às opções e aos preços de uma mesma loja.</p>
            </div>
            <div class="col-6">
                <h2 class="homeh"><i class="fas fa-calendar-check"></i><br>Para qualquer ocasião particular</h2>
                <p>Utilize o Gifty para casamento, formatura, aniversário ou qualquer
                    outro evento particular.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button id="saibamais"><a href="<?= base_url('sobre') ?>">Saiba mais</a></button>
            </div>
        </div>
    </section>
</main>