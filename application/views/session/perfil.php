<main>
    <article>
        <div class="container">
            <div class="grid-16">
                <h2>Perfil</h2>
                <img src="<?= base_url('assets/img/profiles/' . $usuario->imagem) ?>" 
                     alt="Foto de perfil de <?= $usuario->nome ?> <?= $usuario->sobrenome ?>">
                <ul>
                    <li>Nome: <?= $usuario->nome ?> <?= $usuario->sobrenome ?></li>
                    <li>Data de Nascimento: <?= date_format(date_create($usuario->dataNasc), 'd/m/Y') ?></li>
                    <li>Gênero: <?= $usuario->genero ?></li>
                    <li>CPF: <?=
                            substr($usuario->cpf, 0, 3) . '.' . substr($usuario->cpf, 3, 3) . '.'
                            . substr($usuario->cpf, 6, 3) . '-' . substr($usuario->cpf, 9, 2)
                            ?></li>
                    <li>Nome de Usuário: <?= $usuario->nomeUsuario ?></li>
                    <li>E-mail: <?= $usuario->email ?></li>                    
                </ul>      
            </div>
        </div>
    </article>
</main>