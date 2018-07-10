<script src="<?= base_url('assets/js/ajax.js') ?>"></script>
<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Nova Lista</h1>
            </div>
            <form method="post" action="<?= base_url('admin/eventos/grava_adicao') ?>">
                <div class="col-12">
                    <br><h2>Evento</h2>
                </div>
                <div class="col-7">
                    <label for="titulo">Título</label><br>
                    <input type="text" id="titulo" name="titulo" pattern="[A-Za-z]{,100}" 
                           maxlength="100" required><br><br>
                </div>                
                <div class="col-3">
                    <label for="data">Data</label><br>
                    <input type="date" id="data" name="data" required><br><br>
                </div>
                <div class="col-2">
                    <label for="hora">Hora</label><br>
                    <input type="time" id="hora" name="hora" required><br><br>
                </div>
                <div class="col-5">
                    <label for="idTipoEvento">Tipo de Evento</label><br>
                    <select id="idTipoEvento" name="idTipoEvento">
                        <?php foreach ($tiposeventos as $tipoevento) { ?>
                            <option value="<?= $tipoevento->id ?>"><?= $tipoevento->descricao ?></option>
                        <?php } ?>
                    </select><br><br>
                </div>
                <div class="col-4">
                    <label for="maxItens">Máximo de Itens Por Convidado</label><br>
                    <input type="text" id="maxItens" name="maxItens" pattern="[0-9]{,2}" 
                           maxlength="2" required><br><br>
                </div>
                <div class="col-3">
                    <label for="dataLimite">Data Limite de Confirmação</label><br>
                    <input type="date" id="dataLimite" name="dataLimite" required><br><br>
                </div>
                <div class="col-12">
                    <label for="descricao">Descrição</label><br>
                    <textarea id="descricao" name="descricao" pattern="[A-Za-z0-9]" rows="5" required></textarea><br><br>
                </div>
                <div class="col-8">
                    <label for="local">Nome do Local</label><br>
                    <input type="text" id="local" name="local" pattern="[A-Za-z0-9]{,100}" 
                           maxlength="100" required><br><br>
                </div>
                <div class="col-4">
                    <label for="CEP">CEP</label>
                    <input type="text" id="cep" name="cep" required title="Apenas os 8 números."
                           title="Apenas números." pattern="[0-9]{8}" maxlength="8"
                           placeholder="99999999"><br><br>
                </div>
                <div class="col-6">
                    <label for="logradouro">Logradouro</label><br>
                    <input type="text" id="logradouro" name="logradouro" readonly><br><br>
                </div>
                <div class="col-2">
                    <label for="numero">Número</label><br>
                    <input type="text" id="numero" name="numero" required
                           pattern="[0-9]{,12}" maxlength="12"><br><br>
                </div>
                <div class="col-4">
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
                    <h2>Convidados</h2>
                </div>
                <?php foreach ($amizades as $amizade) { ?>
                    <div class="col-3">
                        <?php if ($this->session->id == $amizade->idUsuario1) { ?>
                            <img style="width: 100%; height: 12em" src="<?= base_url('assets/img/profiles/') . $amizade->idUsuario2 . '.jpg' ?>"><br>
                        <?php } else { ?>
                            <img style="width: 100%; height: 12em" src="<?= base_url('assets/img/profiles/') . $amizade->idUsuario1 . '.jpg' ?>"><br>
                        <?php } ?>
                            <a href="#">Convidar</a><br><br>
                    </div>
                <?php } ?>
                <div class="col-12">
                    <br><h2>Lista de Presentes</h2>
                </div>
                <div class="col-12">
                    <br>
                    <input type="submit" value="Finalizar"><br>
                </div>
            </form>            
        </div>
    </section>    
</main>