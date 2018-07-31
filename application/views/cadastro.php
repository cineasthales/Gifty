<script src="<?= base_url('assets/js/ajax.js') ?>"></script>
<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Cadastrar</h1>
            </div>
            <form method="post" action="<?= base_url('gifty/grava_cadastro') ?>">
                <div class="col-12">
                    <br>
                    <h2>Seus Dados</h2>
                </div>
                <div class="col-6">
                    <label for="nome">Nome</label> <span class="asterisco">*</span><br>
                    <input type="text" id="nome" name="nome" pattern="[A-Za-z]{,50}" 
                           maxlength="50" required><br><br>
                </div>
                <div class="col-6">
                    <label for="sobrenome">Sobrenome</label> <span class="asterisco">*</span><br>
                    <input type="text" id="sobrenome" name="sobrenome" 
                           maxlength="100" pattern="[A-Za-z]{,100}" required><br><br>
                </div>
                <div class="col-6">
                    <label for="genero">Gênero</label> <span class="asterisco">*</span><br>
                    <select id="genero" name="genero">
                        <option value="Feminino">Feminino</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Transexual">Transexual</option>
                        <option value="Travesti">Travesti</option>
                        <option value="Não-Binário">Não-Binário</option>
                        <option value="Outro">Outro</option>
                    </select><br><br>
                </div>
                <div class="col-6">
                    <label for="dataNasc">Data de Nascimento</label> <span class="asterisco">*</span><br>
                    <input type="date" id="dataNasc" name="dataNasc" required><br><br>
                </div>
                <div class="col-6">
                    <label for="cpf">CPF</label> <span class="asterisco">*</span>
                    <span id="msgCpf" name="msgCpf"></span><br>
                    <input type="text" id="cpf" name="cpf" title="Apenas os 11 números."
                           maxlength="11" pattern="[0-9]{11}" required placeholder="99999999999"><br><br>
                </div>
                <div class="col-6">
                    <label for="nomeUsuario">Nome de Usuário</label> <span class="asterisco">*</span>
                    <span id="msgNomeUsuario" name="msgNomeUsuario"></span><br>
                    <input type="text" id="nomeUsuario" name="nomeUsuario" required
                           pattern="[A-Za-z0-9]{,20}" maxlength="20"><br><br>
                </div>
                <div class="col-6">
                    <label for="email">E-mail</label> <span class="asterisco">*</span>
                    <span id="msgEmail" name="msgEmail"></span><br>
                    <input type="email" id="email" name="email" required
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"><br>
                </div>
                <div class="col-6">
                    <label for="senha">Senha</label> <span class="asterisco">*</span><br>
                    <input type="password" id="senha" name="senha" 
                           title="Mínimo 8 caracteres, pelo menos uma letra maiúscula, uma letra minúscula e um dígito." required
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}" maxlength="32"><br>
                </div>
<!--                <div class="col-6">
                    <label for="confirmarsenha">Confirmar Senha</label> <span class="asterisco">*</span>
                    <span id="msgSenha" name="msgSenha"></span><br>
                    <input type="password" id="confirmarsenha" name="confirmarsenha" maxlength="32"><br><br>
                </div>-->                
                <div class="col-12"><br>
                    <label for="notificaEmail">
                        <input type="checkbox" id="notificaEmail" name="notificaEmail"> Receber notificações por e-mail
                    </label><br><br>
                </div>
<!--                <div class="col-6">
                    <label for="imagem">Foto de Perfil</label><br>
                    <input type="file" id="imagem" name="imagem" accept=".gif, .jpg, .jpeg, .png"><br><br>
                </div>-->
                <div class="col-12">
                    <br><h2>Seu Endereço</h2>
                </div>
                <div class="col-6">
                    <label for="CEP">CEP</label> <span class="asterisco">*</span><br>
                    <input type="text" id="cep" name="cep" required title="Apenas os 8 números."
                           title="Apenas números." pattern="[0-9]{8}" maxlength="8"
                           placeholder="99999999"><br><br>
                </div>
                <div class="col-6">
                    <label for="logradouro">Logradouro</label><br>
                    <input type="text" id="logradouro" name="logradouro" readonly><br><br>
                </div>
                <div class="col-6">
                    <label for="numero">Número</label> <span class="asterisco">*</span><br>
                    <input type="text" id="numero" name="numero" required
                           pattern="[0-9]{,12}" maxlength="12"><br><br>
                </div>
                <div class="col-6">
                    <label for="complemento">Complemento</label><br>
                    <input type="text" id="complemento" name="complemento"
                           pattern="[A-Za-z0-9]{,100}" maxlength="100"><br><br>
                </div>
                <div class="col-5">
                    <label for="bairro">Bairro</label><br>
                    <input type="text" id="bairro" name="bairro" readonly><br><br><br>
                </div>
                <div class="col-5">
                    <label for="cidade">Cidade</label><br>
                    <input type="text" id="cidade" name="cidade" readonly><br><br><br>
                </div>
                <div class="col-2">
                    <label for="estado">Estado</label><br>
                    <input type="text" id="estado" name="estado" readonly><br><br><br>
                </div>
                <div class="col-12">
                    <h2>Seus Interesses</h2>
                    <small>Marque quantas opções quiser. Isto ajudará nosso sistema
                        a recomendar itens mais adequados para você.
                        <a href="<?= base_url('gifty/sobre') ?>" target="_blank">Saiba mais</a></small><br><br>
                </div>
                <div class="col-4">
                    <label for="categoria_1">
                        <input type="checkbox" id="categoria_1" name="categoria_1"> Acessórios para Veículos
                    </label><br>                    
                    <label for="categoria_2">
                        <input type="checkbox" id="categoria_2" name="categoria_2"> Agro, Indústria e Comércio 
                    </label><br>
                    <label for="categoria_3">
                        <input type="checkbox" id="categoria_3" name="categoria_3"> Alimentos e Bebidas
                    </label><br>
                    <label for="categoria_4">
                        <input type="checkbox" id="categoria_4" name="categoria_4"> Animais
                    </label><br>
                    <label for="categoria_5">
                        <input type="checkbox" id="categoria_5" name="categoria_5"> Antiguidades
                    </label><br>
                    <label for="categoria_6">
                        <input type="checkbox" id="categoria_6" name="categoria_6"> Arte e Artesanato
                    </label><br>
                    <label for="categoria_28">
                        <input type="checkbox" id="categoria_28" name="categoria_28"> Artigos de Armarinho
                    </label><br>
                    <label for="categoria_7">
                        <!-- Bebês -->
                        <input type="checkbox" id="categoria_7" name="categoria_7"> Artigos para Bebês
                    </label><br>
                    <label for="categoria_8">
                        <input type="checkbox" id="categoria_8" name="categoria_8"> Beleza e Cuidado Pessoal 
                    </label><br>
                    <label for="categoria_9">
                        <input type="checkbox" id="categoria_9" name="categoria_9"> Brinquedos e Hobbies
                    </label><br>
                </div>
                <div class="col-4">                    
                    <label for="categoria_10">
                        <!-- Calçados, Roupas e Bolsas -->
                        <input type="checkbox" id="categoria_10" name="categoria_10"> Calçados, Roupas e Acessórios
                    </label><br>
                    <label for="categoria_11">
                        <input type="checkbox" id="categoria_11" name="categoria_11"> Câmeras e Acessórios
                    </label><br>
                    <label for="categoria_12">
                        <!-- Carros, Motos e Outros -->
                        <input type="checkbox" id="categoria_12" name="categoria_12"> Carros, Motos e Outros Veículos
                    </label><br>
                    <label for="categoria_13">
                        <input type="checkbox" id="categoria_13" name="categoria_13"> Casa, Móveis e Decoração 
                    </label><br>                    
                    <label for="categoria_15">
                        <input type="checkbox" id="categoria_15" name="categoria_15"> Coleções e Comics 
                    </label><br>
                    <label for="categoria_16">
                        <input type="checkbox" id="categoria_16" name="categoria_16"> Eletrodomésticos 
                    </label><br>
                    <label for="categoria_17">
                        <input type="checkbox" id="categoria_17" name="categoria_17"> Eletrônicos, Áudio e Vídeo 
                    </label><br>
                    <label for="categoria_29">
                        <input type="checkbox" id="categoria_29" name="categoria_29"> Esoterismo e Ocultismo
                    </label><br>
                    <label for="categoria_18">
                        <input type="checkbox" id="categoria_18" name="categoria_18"> Esportes e Fitness
                    </label><br>
                    <label for="categoria_19">
                        <input type="checkbox" id="categoria_19" name="categoria_19"> Ferramentas e Construção
                    </label><br>                    
                </div>
                <div class="col-4">
                    <label for="categoria_20">
                        <input type="checkbox" id="categoria_20" name="categoria_20"> Filmes e Seriados 
                    </label><br>
                    <label for="categoria_21">
                        <input type="checkbox" id="categoria_21" name="categoria_21"> Games
                    </label><br> 
                    <label for="categoria_22">
                        <input type="checkbox" id="categoria_22" name="categoria_22"> Informática
                    </label><br>
                    <label for="categoria_27">
                        <!-- Saúde -->
                        <input type="checkbox" id="categoria_27" name="categoria_27"> Instrumentos de Saúde 
                    </label><br>
                    <label for="categoria_23">
                        <input type="checkbox" id="categoria_23" name="categoria_23"> Instrumentos Musicais
                    </label><br>
                    <label for="categoria_24">
                        <input type="checkbox" id="categoria_24" name="categoria_24"> Joias e Relógios 
                    </label><br>
                    <label for="categoria_25">
                        <input type="checkbox" id="categoria_25" name="categoria_25"> Livros
                    </label><br>
                    <label for="categoria_30">
                        <input type="checkbox" id="categoria_30" name="categoria_30"> Materiais Escolares
                    </label><br>
                    <label for="categoria_26">
                        <input type="checkbox" id="categoria_26" name="categoria_26"> Música 
                    </label><br>             
                    <label for="categoria_14">
                        <!-- Celulares e Telefones -->
                        <input type="checkbox" id="categoria_14" name="categoria_14"> Telefonia
                    </label><br>
                </div>
                <div class="col-12">
                    <br><br>
                    <input type="submit" value="Registrar"><br>
                </div>
            </form>
        </div>
    </section>
</main>