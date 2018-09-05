<script src="<?= base_url('assets/js/ajax.js') ?>"></script>
<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Atualizar Cadastro</h1>
            </div>
            <form method="post" action="<?= base_url('usuario/configuracoes/grava_atualizacao') ?>">
                <div class="col-12">
                    <br>
                    <h2>Seus Dados</h2>
                </div>
                <div class="col-6">
                    <label for="nome">Nome</label> <span class="asterisco">*</span><br>
                    <input type="text" id="nome" name="nome" pattern="[A-Za-z]{,50}" 
                           maxlength="50" required value="<?= $usuario->nome ?>"><br><br>
                </div>
                <div class="col-6">
                    <label for="sobrenome">Sobrenome</label> <span class="asterisco">*</span><br>
                    <input type="text" id="sobrenome" name="sobrenome" 
                           maxlength="100" pattern="[A-Za-z]{,100}" required
                           value="<?= $usuario->sobrenome ?>"><br><br>
                </div>
                <div class="col-6">
                    <label for="genero">Gênero</label> <span class="asterisco">*</span><br>
                    <select id="genero" name="genero" required>
                        <?php
                        if ($usuario->genero == 'Feminino') {
                            echo '<option selected value="Feminino">Feminino</option>';
                        } else {
                            echo '<option value="Feminino">Feminino</option>';
                        }
                        if ($usuario->genero == 'Masculino') {
                            echo '<option selected value="Masculino">Masculino</option>';
                        } else {
                            echo '<option value="Masculino">Masculino</option>';
                        }
                        if ($usuario->genero == 'Transexual') {
                            echo '<option selected value="Transexual">Transexual</option>';
                        } else {
                            echo '<option value="Transexual">Transexual</option>';
                        }
                        if ($usuario->genero == 'Travesti') {
                            echo '<option selected value="Travesti">Travesti</option>';
                        } else {
                            echo '<option value="Travesti">Travesti</option>';
                        }
                        if ($usuario->genero == 'Não-Binário') {
                            echo '<option selected value="Não-Binário">Não-Binário</option>';
                        } else {
                            echo '<option value="Não-Binário">Não-Binário</option>';
                        }
                        if ($usuario->genero == 'Outro') {
                            echo '<option selected value="Outro">Outro</option>';
                        } else {
                            echo '<option value="Outro">Outro</option>';
                        }
                        ?>
                    </select><br><br>
                </div>
                <div class="col-6">
                    <label for="dataNasc">Data de Nascimento</label> <span class="asterisco">*</span><br>
                    <input type="date" id="dataNasc" name="dataNasc" required
                           value="<?= $usuario->dataNasc ?>"><br><br>
                </div>
                <div class="col-6">
                    <label for="cpf">CPF</label> <span class="asterisco">*</span>
                    <span id="msgCpf" name="msgCpf"></span><br>
                    <input type="text" id="cpf" name="cpf" title="Apenas os 11 números."
                           maxlength="11" pattern="[0-9]{11}" required placeholder="99999999999"
                           value="<?= $usuario->cpf ?>"><br><br>
                </div>
                <div class="col-6">
                    <label for="nomeUsuario">Nome de Usuário</label> <span class="asterisco">*</span>
                    <span id="msgNomeUsuario" name="msgNomeUsuario"></span><br>
                    <input type="text" id="nomeUsuario" name="nomeUsuario" required
                           pattern="[A-Za-z0-9]{,20}" maxlength="20"
                           value="<?= $usuario->nomeUsuario ?>"><br><br>
                </div>
                <div class="col-6">
                    <label for="email">E-mail</label> <span class="asterisco">*</span>
                    <span id="msgEmail" name="msgEmail"></span><br>
                    <input type="email" id="email" name="email" required
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                           value="<?= $usuario->email ?>"><br>
                </div>            
                <div class="col-12"><br>
                    <label for="notificaEmail">
                            <?php
                            if ($usuario->notificaEmail == 1) {
                                echo '<input type="checkbox" id="notificaEmail" name="notificaEmail" checked> Notificações';
                            } else {
                                echo '<input type="checkbox" id="notificaEmail" name="notificaEmail"> Notificações';
                            }
                            ?>
                        </label><br><br>
                </div>
                <div class="col-12">
                    <br><h2>Seu Endereço</h2>
                </div>
                <div class="col-6">
                    <label for="CEP">CEP</label> <span class="asterisco">*</span><br>
                    <input type="text" id="cep" name="cep" required title="Apenas os 8 números."
                           title="Apenas números." pattern="[0-9]{8}" maxlength="8"
                           placeholder="99999999" value="<?= $usuario->cep ?>"><br><br>
                </div>
                <div class="col-6">
                    <label for="logradouro">Logradouro</label><br>
                    <input type="text" id="logradouro" name="logradouro" readonly
                           value="<?= $usuario->logradouro ?>"><br><br>
                </div>
                <div class="col-6">
                    <label for="numero">Número</label> <span class="asterisco">*</span><br>
                    <input type="text" id="numero" name="numero" required
                           pattern="[0-9]{,12}" maxlength="12" value="<?= $usuario->numero ?>"><br><br>
                </div>
                <div class="col-6">
                    <label for="complemento">Complemento</label><br>
                    <input type="text" id="complemento" name="complemento"
                           pattern="[A-Za-z0-9]{,100}" maxlength="100" value="<?= $usuario->complemento ?>"><br><br>
                </div>
                <div class="col-5">
                    <label for="bairro">Bairro</label><br>
                    <input type="text" id="bairro" name="bairro" readonly value="<?= $usuario->bairro ?>"><br><br><br>
                </div>
                <div class="col-5">
                    <label for="cidade">Cidade</label><br>
                    <input type="text" id="cidade" name="cidade" readonly value="<?= $usuario->cidade ?>"><br><br><br>
                </div>
                <div class="col-2">
                    <label for="estado">Estado</label><br>
                    <input type="text" id="estado" name="estado" readonly value="<?= $usuario->estado ?>"><br><br><br>
                </div>
                <div class="col-12">
                    <br><br>
                    <input type="submit" value="Atualizar"><br>
                </div>
            </form>
        </div>
    </section>
</main>