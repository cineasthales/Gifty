<script src="<?= base_url('assets/js/ajax2.js') ?>"></script>
<script>
    function previewFile() {
        var preview = document.getElementById('foto');
        var file = document.getElementById('imagem').files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }
</script>
<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Atualizar Cadastro</h1>
            </div>
            <form method="post" enctype="multipart/form-data" action="<?= base_url('usuario/configuracoes/grava_atualizacao_dados') ?>">
                <div class="col-12">
                    <br><h2>Seus Dados</h2>
                    <small>Para sua segurança, alguns dados não podem ser livremente atualizados.
                        Na excepcionalidade de precisar atualizá-los, entre em
                        <a href="mailto:cineasthales@gmail.com">contato</a>
                        com nossa equipe.</small><br><br>
                </div>
                <?php
                if (file_exists('assets/img/profiles/' . $usuario->imagem)) {
                    $foto = base_url('assets/img/profiles/' . $usuario->imagem);
                } else {
                    $foto = base_url('assets/img/misc/generic-profile.jpg');
                }
                ?>
                <div class="col-5">
                    <label for="imagem">Foto de Perfil</label><br>
                    <input type="file" id="imagem" name="imagem" 
                           onchange="previewFile()" accept=".jpg, .jpeg, .png"><br>
                    <img src="<?= $foto ?>" id="foto" style="width: 100%" alt="Foto"><br><br>
                </div>
                <div class="col-7">
                    <label for="nome">Nome</label><br>
                    <input type="text" id="nome" name="nome" pattern="[A-Za-z]{,50}" 
                           maxlength="50" required readonly value="<?= $usuario->nome ?>"><br><br>
                </div>
                <div class="col-7">
                    <label for="sobrenome">Sobrenome</label><br>
                    <input type="text" id="sobrenome" name="sobrenome" 
                           maxlength="100" pattern="[A-Za-z]{,100}" required
                           value="<?= $usuario->sobrenome ?>" readonly><br><br>
                </div>
                <div class="col-4">
                    <label for="genero">Gênero</label>
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
                <div class="col-3">
                    <label for="dataNasc">Data de Nascimento</label><br>
                    <input type="date" id="dataNasc" name="dataNasc" required
                           value="<?= $usuario->dataNasc ?>" readonly><br><br>
                </div>
                <div class="col-7">
                    <label for="cpf">CPF</label>
                    <span id="msgCpf" name="msgCpf"></span><br>
                    <input type="text" id="cpf" name="cpf" title="Apenas os 11 números."
                           maxlength="11" pattern="[0-9]{11}" required placeholder="99999999999"
                           value="<?= $usuario->cpf ?>" readonly><br><br>
                </div>
                <div class="col-7">
                    <label for="nomeUsuario">Nome de Usuário</label>
                    <span id="msgNomeUsuario" name="msgNomeUsuario"></span><br>
                    <input type="text" id="nomeUsuario" name="nomeUsuario" required
                           pattern="[A-Za-z0-9]{,20}" maxlength="20"
                           value="<?= $usuario->nomeUsuario ?>" readonly><br><br>
                </div>
                <div class="col-7">
                    <label for="email">E-mail</label>
                    <span id="msgEmail" name="msgEmail"></span><br>
                    <input type="email" id="email" name="email" required
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                           value="<?= $usuario->email ?>"><br>
                </div>            
                <div class="col-7"><br>
                    <label for="notificaEmail">
                        <?php
                        if ($usuario->notificaEmail == 1) {
                            echo '<input type="checkbox" id="notificaEmail" name="notificaEmail" checked> Receber notificações por e-mail';
                        } else {
                            echo '<input type="checkbox" id="notificaEmail" name="notificaEmail"> Receber notificações por e-mail';
                        }
                        ?>
                    </label><br>
                </div>
                <div class="col-12">
                    <br><h2>Seu Endereço</h2>
                </div>
                <div class="col-12" style="display: none">
                    <input type="text" id="idEndereco" name="idEndereco"
                           value="<?= $usuario->idEndereco ?>">
                </div>
                <div class="col-5">
                    <label for="CEP">CEP</label><br>
                    <input type="text" id="cep" name="cep" required title="Apenas os 8 números."
                           pattern="[0-9]{8}" maxlength="8"
                           placeholder="99999999" value="<?= $usuario->cep ?>"><br><br>
                </div>
                <div class="col-7">
                    <label for="logradouro">Logradouro</label><br>
                    <input type="text" id="logradouro" name="logradouro" readonly
                           value="<?= $usuario->logradouro ?>"><br><br>
                </div>
                <div class="col-5">
                    <label for="numero">Número</label><br>
                    <input type="text" id="numero" name="numero" required
                           pattern="[0-9]{,12}" maxlength="12" value="<?= $usuario->numero ?>"><br><br>
                </div>
                <div class="col-7">
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
                    <br>
                    <input type="submit" value="Atualizar"><br>
                </div>
            </form>
        </div>
    </section>
</main>