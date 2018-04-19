<script src="<?= base_url('assets/js/ajax.js') ?>"></script>
<main>
    <article>
        <div class="container">
            <div class="grid-16">
                <h2>Cadastre-se!</h2>
                <form method="post" action="#">
                    <h3>Sobre Você</h3>
                    <div>
                        <label for="nome">Nome</label> <span class="asterisco">*</span><br>
                        <input type="text" id="nome" name="nome" pattern="[A-Za-z]{,50}" 
                               maxlength="50" required><br><br>
                    </div>
                    <div>
                        <label for="sobrenome">Sobrenome</label> <span class="asterisco">*</span><br>
                        <input type="text" id="sobrenome" name="sobrenome" 
                               maxlength="100" pattern="[A-Za-z]{,100}" required><br><br>
                    </div>
                    <div>
                        <label for="sexo">Sexo</label> <span class="asterisco">*</span><br>
                        <select id="sexo" name="sexo">
                            <option value=""></option>
                            <option value="Feminino">Feminino</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Outros">Outros</option>
                        </select><br><br>
                    </div>
                    <div>
                        <label for="dataNasc">Data de Nascimento</label> <span class="asterisco">*</span><br>
                        <input type="date" id="dataNasc" name="dataNasc" required><br><br>
                    </div> 
                    <div>
                        <label for="cpf">CPF</label> <span class="asterisco">*</span>
                        <span id="msgCpf" name="msgCpf"></span><br>
                        <small>Apenas os 11 números.</small><br>
                        <input type="text" id="cpf" name="cpf" title="Apenas os 11 números."
                               maxlength="11" pattern="[0-9]{11}" required><br><br>
                    </div>                    
                    <div>
                        <label for="email">E-mail</label> <span class="asterisco">*</span>
                        <span id="msgEmail" name="msgEmail"></span><br>
                        <input type="email" id="email" name="email" required
                               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"><br><br>
                    </div>
                    <div>
                        <label for="notificarEmail">
                            <input type="checkbox" id="notificarEmail" name="notificarEmail"> Receber notificações por e-mail
                        </label><br><br>
                    </div>
                    <div>
                        <label for="nomeUsuario">Nome de Usuário</label> <span class="asterisco">*</span>
                        <span id="msgNomeUsuario" name="msgNomeUsuario"></span><br>
                        <input type="text" id="nomeUsuario" name="nomeUsuario" required
                               pattern="[A-Za-z0-9]{,20}" maxlength="20"><br><br>
                    </div>
                    <div>
                        <label for="senha">Senha</label> <span class="asterisco">*</span><br>
                        <input type="password" id="senha" name="senha" 
                               title="Mínimo 8 caracteres, pelo menos uma letra maiúscula, uma letra minúscula e um dígito." required
                               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}" maxlength="32"><br><br>
                    </div>
                    <div>
                        <label for="imagem">Foto de Perfil</label> <span class="asterisco">*</span><br>
                        <input type="file" id="imagem" name="imagem" accept=".gif, .jpg, .jpeg, .png" required><br><br>
                    </div>       
                    <br><h3>Seu Endereço</h3>
                    <div>
                        <label for="CEP">CEP</label> <span class="asterisco">*</span><br>
                        <small>Apenas os 8 números.</small><br>
                        <input type="text" id="cep" name="cep" required title="Apenas os 8 números."
                               title="Apenas números." pattern="[0-9]{8}" maxlength="8"><br><br>
                    </div>
                    <div>
                        <label for="logradouro">Logradouro</label><br>
                        <input type="text" id="logradouro" name="logradouro" required readonly><br><br>
                    </div>
                    <div>
                        <label for="numero">Número</label> <span class="asterisco">*</span><br>
                        <input type="text" id="numero" name="numero" required
                               pattern="[0-9]{,12}" maxlength="12"><br><br>
                    </div>
                    <div>
                        <label for="complemento">Complemento</label><br>
                        <input type="text" id="complemento" name="complemento"
                               pattern="[A-Za-z0-9]{,100}" maxlength="100"><br><br>
                    </div>
                    <div>
                        <label for="bairro">Bairro</label><br>
                        <input type="text" id="bairro" name="bairro" required readonly><br><br>
                    </div>
                    <div>
                        <label for="cidade">Cidade</label><br>
                        <input type="text" id="cidade" name="cidade" required readonly><br><br>
                    </div>
                    <div>
                        <label for="estado">Estado</label><br>
                        <input type="text" id="estado" name="estado" required readonly><br><br>
                    </div>            
                    <div>  
                        <input type="submit" value="Enviar"><br><br>
                    </div>
                </form>
            </div>
        </div>
    </article>
</main>