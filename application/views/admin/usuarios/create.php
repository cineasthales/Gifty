<?php
if ($this->session->has_userdata('mensagem')) {
    $mensagem = $this->session->flashdata('mensagem');
    $tipo = $this->session->flashdata('tipo');
    if ($tipo) {
        ?>
        <section class="alerta_sucesso">
            <div class="row-plus">
                <div class="col-12">
                    <small><strong>Sucesso!</strong> <?= $mensagem ?></small>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <section class="alerta_erro">
            <div class="row-plus">
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
    <section>
        <div class="row-plus"> 
            <div class="col-12">
                <h1>Adicionar Usuário</h1>
            </div>
            <form method="post" action="<?= base_url('admin/usuarios/grava_adicao') ?>">
                <div class="col-6">
                    <label for="nome">Nome</label><br>
                    <input type="text" id="nome" name="nome" pattern="[A-Za-z]{,50}" 
                           maxlength="50" required><br><br>
                </div>
                <div class="col-6">
                    <label for="sobrenome">Sobrenome</label><br>
                    <input type="text" id="sobrenome" name="sobrenome" 
                           maxlength="100" pattern="[A-Za-z]{,100}" required><br><br>
                </div>
                <div class="col-6">
                    <label for="genero">Gênero</label><br>
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
                    <label for="dataNasc">Data de Nascimento</label><br>
                    <input type="date" id="dataNasc" name="dataNasc" required><br><br>
                </div>
                <div class="col-6">
                    <label for="cpf">CPF</label><br>
                    <input type="text" id="cpf" name="cpf" title="Apenas os 11 números."
                           maxlength="11" pattern="[0-9]{11}" required placeholder="99999999999"><br><br>
                </div>
                <div class="col-6">
                    <label for="email">E-mail</label><br>
                    <input type="email" id="email" name="email" required
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"><br><br>
                </div>
                <div class="col-6">
                    <label for="nomeUsuario">Nome de Usuário</label><br>
                    <input type="text" id="nomeUsuario" name="nomeUsuario" required
                           pattern="[A-Za-z0-9]{,20}" maxlength="20"><br><br>
                </div>
                <div class="col-6">
                    <label for="senha">Senha</label><br>
                    <input type="password" id="senha" name="senha" 
                           title="Mínimo 8 caracteres, pelo menos uma letra maiúscula, uma letra minúscula e um dígito." required
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}" maxlength="32"><br><br>
                </div>
                <span style='text-align: center'>
                    <div class="col-2"><br>
                        <label for="ativo">
                            <input type="checkbox" id="ativo" name="ativo"> Ativo
                        </label><br><br>
                    </div>
                    <div class="col-2"><br>
                        <label for="notificaEmail">
                            <input type="checkbox" id="notificaEmail" name="notificaEmail"> Notificações
                        </label><br><br>
                    </div>
                    <div class="col-2"><br>
                        <label for="nivel">
                            <input type="checkbox" id="nivel" name="nivel"> Admin
                        </label><br><br>
                    </div>
                </span>
                <div class="col-6">
                    <label for="imagem">Foto de Perfil</label><br>
                    <input type="file" id="imagem" name="imagem" accept=".gif, .jpg, .jpeg, .png"><br><br>
                </div>
                <div class="col-12">
                    <label for="idEndereco">Endereço</label><br>
                    <select id="idEndereco" name="idEndereco" size="5">
                        <?php foreach ($enderecos as $endereco) { ?>
                            <option value="<?= $endereco->id ?>">                             
                                # <?= $endereco->id ?> - 
                                <?= $endereco->logradouro ?>, <?= $endereco->numero ?>
                                <?php
                                if ($endereco->complemento) {
                                    echo ' - ' . $endereco->complemento;
                                }
                                ?>
                                - <?= $endereco->bairro ?> - <?=
                                substr($endereco->cep, 0, 2) . '.' . substr($endereco->cep, 2, 3) . '-'
                                . substr($endereco->cep, 5, 3)
                                ?> 
                                - <?= $endereco->cidade ?> / <?= $endereco->estado ?>
                            </option>
                        <?php } ?>
                    </select><br><br>
                </div>
                <div class="col-12">
                    <br>
                    <input type="submit" value="Salvar"><br>
                </div>
            </form>
        </div>
    </section>    
</main>