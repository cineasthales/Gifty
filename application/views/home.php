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
                <div class="container">
                        <div class="grid-15">
                            <small><strong>Sucesso!</strong> <?= $mensagem ?></small>
                        </div>
                        <div class="grid-1">
                            <small id="xis"><a href="#">X</a></small>
                        </div>
                </div>
            </article>
        <?php } else { ?>
            <article class="alerta_erro">
                <div class="container">
                        <div class="grid-15">
                            <small><strong>Erro.</strong> <?= $mensagem ?></small>
                        </div>
                        <div class="grid-1">
                            <small id="xis"><a href="#">X</a></small>
                        </div>
                </div>
            </article>
            <?php
        }
    }
    ?>
    <article>
        <div class="container">
            <div class="grid-16">
                <h2>Listas de presentes personalizadas</h2>
                <button><a href="<?= base_url('home/cadastrar') ?>">Cadastre-se</a></button>
            </div>
        </div>
    </article>
    <article class="fundoAlt">
        <div class="container">
            <div class="grid-16">
                <h2>Para qualquer evento particular</h2>
                <p>Mussum Ipsum, cacilds vidis litro abertis. Delegadis gente finis, 
                    bibendum egestas augue arcu ut est. Cevadis im ampola pa arma uma 
                    pindureta. Nullam volutpat risus nec leo commodo, ut interdum diam 
                    laoreet. Sed non consequat odio. Aenean aliquam molestie leo, vitae 
                    iaculis nisl.</p>
            </div>            
        </div>
    </article>
    <article>
        <div class="container">
            <div class="grid-16">
                <h2>O que você vai ganhar ainda será um segredo</h2>
                <p>Mussum Ipsum, cacilds vidis litro abertis. Delegadis gente finis, 
                    bibendum egestas augue arcu ut est. Cevadis im ampola pa arma uma 
                    pindureta. Nullam volutpat risus nec leo commodo, ut interdum diam 
                    laoreet. Sed non consequat odio. Aenean aliquam molestie leo, vitae 
                    iaculis nisl.</p>
            </div>            
        </div>
    </article>
    <article class="fundoAlt">
        <div class="container" >
            <div class="grid-16">
                <h2>Nunca mais erre o presente</h2>
                <p>Mussum Ipsum, cacilds vidis litro abertis. Delegadis gente finis, 
                    bibendum egestas augue arcu ut est. Cevadis im ampola pa arma uma 
                    pindureta. Nullam volutpat risus nec leo commodo, ut interdum diam 
                    laoreet. Sed non consequat odio. Aenean aliquam molestie leo, vitae 
                    iaculis nisl.</p>
            </div>            
        </div>
    </article>
</main>