<main>
    <?php
// se houver uma variável de sessão definida irá exibir a mensagem
    if ($this->session->has_userdata('mensagem')) {
        // obtém os valores atribuídos às variáveis de sessão
        $mensagem = $this->session->flashdata('mensagem');
        $tipo = $this->session->flashdata('tipo');
        // if ($tipo==1)
        if ($tipo) {
            echo "<article><div class='container'>";
            echo "<div class='grid-16'>";
            echo "<div class='alerta_sucesso'>";
            echo $mensagem . "</div></div></div></article>";
        } else {
            echo "<article><div class='container'>";
            echo "<div class='grid-16'>";
            echo "<div class='alerta_erro'>";
            echo "<strong>Erro. </strong>" . $mensagem . "</div></div></div></article>";
        }
    }
    ?>
    <article>
        <div class="container">
            <div class="grid-16">
                <h2>Listas de presentes personalizadas</h2>
                <a href="<?= base_url('home/cadastrar') ?>"><button>Cadastre-se</button></a>
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