<main>
    <article>
        <div class="container">
            <?php
// se houver uma variável de sessão definida irá exibir a mensagem
            if ($this->session->has_userdata('mensagem')) {
                // obtém os valores atribuídos às variáveis de sessão
                $mensagem = $this->session->flashdata('mensagem');
                $tipo = $this->session->flashdata('tipo');
                // if ($tipo==1)
                if ($tipo) {
                    echo "<div class='grid-16'>";
                    echo "<div class='alerta_sucesso'>";
                    echo $mensagem . "</div></div><br>";
                } else {
                    echo "<div class='grid-16'>";
                    echo "<div class='alerta_erro'>";
                    echo "<strong>Erro. </strong>" . $mensagem . "</div></div><br>";
                }
            }
            ?>            
            <div class="grid-12">
                <h2>Nunca mais erre o presente.</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Fusce faucibus diam non viverra semper. Morbi malesuada finibus mi quis laoreet. 
                    Vestibulum congue, erat ac cursus tincidunt, libero dui aliquet nisl, viverra molestie
                    enim nibh ut arcu. Duis interdum eu est vitae pulvinar. Praesent ultrices nulla non velit
                    luctus, in volutpat odio semper. Morbi tincidunt ac nunc eget interdum. Suspendisse et 
                    sodales ligula. Aliquam erat volutpat. Phasellus in risus in libero bibendum convallis
                    non id ipsum. Mauris commodo sem at risus sodales, fermentum molestie mi sagittis. 
                    Morbi dignissim hendrerit arcu, non faucibus velit consequat vitae.</p>
                <h2>Nunca mais erre o presente.</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Fusce faucibus diam non viverra semper. Morbi malesuada finibus mi quis laoreet. 
                    Vestibulum congue, erat ac cursus tincidunt, libero dui aliquet nisl, viverra molestie
                    enim nibh ut arcu. Duis interdum eu est vitae pulvinar. Praesent ultrices nulla non velit
                    luctus, in volutpat odio semper. Morbi tincidunt ac nunc eget interdum. Suspendisse et 
                    sodales ligula. Aliquam erat volutpat. Phasellus in risus in libero bibendum convallis
                    non id ipsum. Mauris commodo sem at risus sodales, fermentum molestie mi sagittis. 
                    Morbi dignissim hendrerit arcu, non faucibus velit consequat vitae.</p>
            </div>
            <div class="grid-4">
                <form method="post" action="<?= base_url('home/logar') ?>">
                    <div>
                        <label for="user">Nome de Usuário ou E-mail</label><br>
                        <input type="text" id="user" name="user" required><br><br>
                    </div>
                    <div>
                        <label for="senha">Senha</label><br>
                        <input type="password" id="senha" name="senha" required><br><br>
                    </div>
                    <div id="divEntrar">  
                        <input type="submit" value="Entrar" id="btEntrar"><br><br>
                    </div>
                </form>
                <p id="pLogin"><a href="#">Esqueci minha senha</a><br><br>
                    Ainda não é membro? <a href="<?= base_url('home/cadastrar') ?>">Cadastre-se</a>.</p>
            </div>
        </div>
    </article>
</main>