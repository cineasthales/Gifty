<main>
    <?php
// se houver uma variável de sessão definida irá exibir a mensagem
    if ($this->session->has_userdata('mensagem')) {
        // obtém os valores atribuídos às variáveis de sessão
        $mensagem = $this->session->flashdata('mensagem');
        $tipo = $this->session->flashdata('tipo');
        // if ($tipo==1)
        if ($tipo) {
            ?>
            <article class="alerta_sucesso">
                <div class="row">
                        <div class="col-11">
                            <small><strong>Sucesso!</strong> <?= $mensagem ?></small>
                        </div>
                        <div class="col-1">
                            <small id="xis"><a href="#">X</a></small>
                        </div>
                </div>
            </article>
        <?php } else { ?>
            <article class="alerta_erro">
                <div class="row">
                        <div class="col-11">
                            <small><strong>Erro.</strong> <?= $mensagem ?></small>
                        </div>
                        <div class="col-1">
                            <small id="xis"><a href="#">X</a></small>
                        </div>
                </div>
            </article>
            <?php
        }
    }
    ?>
    <article>
        <div class="row">
            <div class="col-12">
                <h1>Listas de presentes personalizadas</h1>
                <button><a href="<?= base_url('home/cadastrar') ?>">Cadastre-se</a></button>
            </div>
        </div>
    </article>
    <article class="fundoAlt">
        <div class="row">
            <div class="col-12">
                <h1>Para qualquer evento particular</h1>
                <p>Mussum Ipsum, cacilds vidis litro abertis. Delegadis gente finis, 
                    bibendum egestas augue arcu ut est. Cevadis im ampola pa arma uma 
                    pindureta. Nullam volutpat risus nec leo commodo, ut interdum diam 
                    laoreet. Sed non consequat odio. Aenean aliquam molestie leo, vitae 
                    iaculis nisl.</p>
            </div>            
        </div>
    </article>
    <article>
        <div class="row">
            <div class="col-12">
                <h1>O que você vai ganhar ainda será um segredo</h1>
                <p>Mussum Ipsum, cacilds vidis litro abertis. Delegadis gente finis, 
                    bibendum egestas augue arcu ut est. Cevadis im ampola pa arma uma 
                    pindureta. Nullam volutpat risus nec leo commodo, ut interdum diam 
                    laoreet. Sed non consequat odio. Aenean aliquam molestie leo, vitae 
                    iaculis nisl.</p>
            </div>            
        </div>
    </article>
    <article class="fundoAlt">
        <div class="row" >
            <div class="col-12">
                <h1>Nunca mais erre o presente</h1>
                <p>Mussum Ipsum, cacilds vidis litro abertis. Delegadis gente finis, 
                    bibendum egestas augue arcu ut est. Cevadis im ampola pa arma uma 
                    pindureta. Nullam volutpat risus nec leo commodo, ut interdum diam 
                    laoreet. Sed non consequat odio. Aenean aliquam molestie leo, vitae 
                    iaculis nisl.</p>
            </div>            
        </div>
    </article>
</main>