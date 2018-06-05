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
                <h1>Atualizar Evento</h1>
            </div>
            <form method="post" action="<?= base_url('admin/eventos/grava_atualizacao/') . $evento->id ?>">
                <div class="col-12">
                    <label for="titulo">Título</label><br>
                    <input type="text" id="titulo" name="titulo" pattern="[A-Za-z]{,100}" value="<?= $evento->titulo ?>"
                           maxlength="100" required><br><br>
                </div>                
                <div class="col-6">
                    <label for="data">Data</label><br>
                    <input type="date" id="data" name="data" required value="<?= $evento->data ?>"><br><br>
                </div>
                <div class="col-6">
                    <label for="hora">Hora</label><br>
                    <input type="time" id="hora" name="hora" required value="<?= $evento->hora ?>"><br><br>
                </div>
                <div class="col-12">
                    <label for="local">Local</label><br>
                    <input type="text" id="local" name="local" pattern="[A-Za-z0-9]{,100}" value="<?= $evento->local ?>"
                           maxlength="100" required><br><br>
                </div> 
                <div class="col-5">
                    <label for="maxItens">Máximo de Itens</label><br>
                    <input type="text" id="maxItens" name="maxItens" pattern="[0-9]{,2}" value="<?= $evento->maxItens ?>"
                           maxlength="2" required><br><br>
                </div>
                <span style='text-align: center'>
                    <div class="col-2"><br>
                        <label for="ativo">
                            <?php
                            if ($evento->ativo == 1) {
                                echo '<input type="checkbox" id="ativo" name="ativo" checked> Ativo';
                            } else {
                                echo '<input type="checkbox" id="ativo" name="ativo"> Ativo';
                            }
                            ?>                            
                        </label><br><br>
                    </div>
                </span>
                <div class="col-5">
                    <label for="dataLimite">Data Limite</label><br>
                    <input type="date" id="dataLimite" name="dataLimite" required
                           value="<?= $evento->dataLimite ?>"><br><br>
                </div>                
                <div class="col-12">
                    <label for="idTipoEvento">Tipo de Evento</label><br>
                    <select id="idTipoEvento" name="idTipoEvento" size="5">
                        <?php foreach ($tiposeventos as $tipoevento) { ?>
                            <?php if ($tipoevento->id == $evento->idTipoEvento) { ?>
                                <option selected value="<?= $tipoevento->id ?>"><?= $tipoevento->descricao ?></option>
                            <?php } else { ?>
                                <option value="<?= $tipoevento->id ?>"><?= $tipoevento->descricao ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select><br><br>
                </div>
                <div class="col-12">
                    <label for="idUsuario">Usuário</label><br>
                    <select id="idUsuario" name="idUsuario" size="5">
                        <?php foreach ($usuarios as $usuario) { ?>
                            <?php if ($usuario->id == $evento->idUsuario) { ?>
                                <option selected value="<?= $usuario->id ?>">                             
                                    # <?= $usuario->id ?> - <?= $usuario->nome ?> <?= $usuario->sobrenome ?>
                                    - <?= $usuario->nomeUsuario ?> - <?= $usuario->email ?>
                                </option>
                            <?php } else { ?>
                                <option value="<?= $usuario->id ?>">                             
                                    # <?= $usuario->id ?> - <?= $usuario->nome ?> <?= $usuario->sobrenome ?>
                                    - <?= $usuario->nomeUsuario ?> - <?= $usuario->email ?>
                                </option>
                            <?php } ?>
                        <?php } ?>
                    </select><br><br>
                </div>
                <div class="col-12">
                    <label for="idEndereco">Endereço</label><br>
                    <select id="idEndereco" name="idEndereco" size="5">
                        <?php foreach ($enderecos as $endereco) { ?>
                            <?php if ($endereco->id == $evento->idEndereco) { ?>
                                <option selected value="<?= $endereco->id ?>">                             
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
                            <?php } else { ?>
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
                        <?php } ?>
                    </select><br><br>
                </div>
                <div class="col-12">
                    <label for="descricao">Descrição</label><br>
                    <textarea id="descricao" name="descricao" pattern="[A-Za-z0-9]" rows="5" required><?= $evento->descricao ?></textarea><br><br>
                </div>
                <div class="col-12">
                    <br>
                    <input type="submit" value="Salvar"><br>
                </div>
            </form>
        </div>
    </section>    
</main>