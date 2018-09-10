<main>
    <section>
        <div class="row"> 
            <div class="col-12">
                <h1>Conta Desativada</h1><br>
            </div>
            <div class="col-9">
                <p>A conta com o email <strong><?= $email ?></strong> está desativada!
                Gostaria de reativá-la?</p>
            </div>
            <div class="col-3">
                <button class="btListas"><a href="<?= base_url('gifty/reativar/') . $id ?>">Reativar Conta</button>
            </div>
        </div>
    </section>
</main>