<main>
    <article>
        <div class="row">
            <div class="col-12">
                <h2>Perfil</h2>
            </div>
            <div class="col-3">
                <img src="<?= base_url('assets/img/misc/generic-profile.jpg') ?>" 
                     alt="Foto de perfil de <?= $usuario->nome ?> <?= $usuario->sobrenome ?>">
            </div>
            <div class="col-9">
                <ul>
                    <li><i class="fas fa-user"></i> <?= $usuario->nome ?> <?= $usuario->sobrenome ?></li>
                    <li><i class="fas fa-birthday-cake"></i> <?= date_format(date_create($usuario->dataNasc), 'd/m/Y') ?></li>
                    <li>Gênero: <?= $usuario->genero ?></li>
                    <li><i class="fas fa-id-card"></i> <?=
                            substr($usuario->cpf, 0, 3) . '.' . substr($usuario->cpf, 3, 3) . '.'
                            . substr($usuario->cpf, 6, 3) . '-' . substr($usuario->cpf, 9, 2)
                            ?></li>
                    <li>Nome de Usuário: <?= $usuario->nomeUsuario ?></li>
                    <li><i class="fas fa-at"></i> <?= $usuario->email ?></li>                    
                </ul>      
            </div>
        </div>
    </article>
</main>