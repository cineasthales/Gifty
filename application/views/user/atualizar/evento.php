<script src="<?= base_url('assets/js/ajax.js') ?>"></script>
<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Atualizar Evento</h1>
                <?php $hoje = date("Y-m-d") ?>
            </div>
            <form method="post" action="<?= base_url('usuario/atualizar/atualiza_evento/' . $evento->id . '/' . $evento->idEndereco) ?>">
                <div class="col-7">
                    <label for="titulo">Título</label><br>
                    <input type="text" id="titulo" name="titulo" pattern="[A-Za-z]{,100}" value="<?= $evento->titulo ?>"
                           maxlength="100" required><br><br>
                </div>                
                <div class="col-3">
                    <label for="data">Data</label><br>
                    <input type="date" id="data" name="data" required min="<?= $hoje ?>" value="<?= $evento->data ?>" onblur="maximoDataLimite()"><br><br>
                </div>
                <div class="col-2">
                    <label for="hora">Hora</label><br>
                    <input type="time" id="hora" name="hora" required value="<?= $evento->hora ?>"><br><br>
                </div>
                <div class="col-5">
                    <label for="idTipoEvento">Tipo de Evento</label><br>
                    <select id="idTipoEvento" name="idTipoEvento">
                        <?php foreach ($tiposeventos as $tipoevento) { ?>
                            <?php if ($evento->idTipoEvento == $tipoevento->id) { ?>
                                <option selected value="<?= $tipoevento->id ?>"><?= $tipoevento->descricao ?></option>
                            <?php } else { ?>
                                <option value="<?= $tipoevento->id ?>"><?= $tipoevento->descricao ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select><br><br>
                </div>
                <div class="col-4">
                    <label for="maxItens">Máximo de Itens Por Convidado</label><br>
                    <input type="number" id="maxItens" name="maxItens" value="<?= $evento->maxItens ?>"
                           min="1" max="99" required><br><br>
                </div>
                <div class="col-3">
                    <label for="dataLimite">Data Limite de Confirmação</label><br>
                    <input type="date" id="dataLimite" name="dataLimite" required min="<?= $hoje ?>" value="<?= $evento->dataLimite ?>"><br><br>
                </div>
                <div class="col-12">
                    <label for="descricao">Descrição</label><br>
                    <textarea id="descricao" name="descricao" pattern="[A-Za-z0-9]" rows="5" required><?= $evento->descricao ?></textarea><br><br>
                </div>
                <div class="col-8">
                    <label for="local">Nome do Local</label><br>
                    <input type="text" id="local" name="local" pattern="[A-Za-z0-9]{,100}" value="<?= $evento->local ?>" 
                           maxlength="100" required><br><br>
                </div>
                <div class="col-4">
                    <label for="CEP">CEP</label>
                    <input type="text" id="cep" name="cep" required title="Apenas os 8 números." value="<?= $evento->cep ?>"
                           title="Apenas números." pattern="[0-9]{8}" maxlength="8"
                           placeholder="99999999"><br><br>
                </div>
                <div class="col-6">
                    <label for="logradouro">Logradouro</label><br>
                    <input type="text" id="logradouro" name="logradouro" readonly value="<?= $evento->logradouro ?>"><br><br>
                </div>
                <div class="col-2">
                    <label for="numero">Número</label><br>
                    <input type="number" id="numero" name="numero" required value="<?= $evento->numero ?>"
                           min="1" maxlength="12"><br><br>
                </div>
                <div class="col-4">
                    <label for="complemento">Complemento</label><br>
                    <input type="text" id="complemento" name="complemento" value="<?= $evento->complemento ?>"
                           pattern="[A-Za-z0-9]{,100}" maxlength="100"><br><br>
                </div>
                <div class="col-5">
                    <label for="bairro">Bairro</label><br>
                    <input type="text" id="bairro" name="bairro" readonly value="<?= $evento->bairro ?>"><br><br><br>
                </div>
                <div class="col-5">
                    <label for="cidade">Cidade</label><br>
                    <input type="text" id="cidade" name="cidade" readonly value="<?= $evento->cidade ?>"><br><br><br>
                </div>
                <div class="col-2">
                    <label for="estado">Estado</label><br>
                    <input type="text" id="estado" name="estado" readonly value="<?= $evento->estado ?>"><br><br><br>
                </div>                
                <div class="col-12">
                    <br>
                    <input type="submit" value="Salvar"><br>
                </div>
            </form>            
        </div>
    </section>    
</main>