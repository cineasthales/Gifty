<main>
    <section>
        <div class="row">
            <div class="col-12">
                <h1>Esqueci minha senha</h1>
            </div>
            <form method="post" action="<?= base_url('gifty/recuperar_senha/') ?>"> 
                <div class="col-10"> 
                    <label for="email">E-mail de recuperação</label><br>
                    <input type="email" id="email" name="email" required
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"><br><br>
                </div>
                <div class="col-2">
                    <input class="btListas" type="submit" value="Enviar" style="float: right"><br>
                </div>
            </form>
        </div>
        </div>
    </section>
</main>