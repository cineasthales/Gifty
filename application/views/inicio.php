<?php
// se houver uma variável de sessão definida irá exibir a mensagem
if ($this->session->has_userdata('mensagem')) {
    // obtém os valores atribuídos às variáveis de sessão
    $mensagem = $this->session->flashdata('mensagem');
    $tipo = $this->session->flashdata('tipo');
    // if ($tipo==1)
    if ($tipo) {
        echo "<div class='alerta_sucesso'>";
        echo $mensagem . "</div><br>";
    } else {
        echo "<div class='alerta_erro'>";
        echo "<strong>Erro. </strong>" . $mensagem . "</div><br>";
    }
}
?>

<div id="divLogin">    
    <form method="post" action="#">
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
