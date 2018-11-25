<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawGenero);
    google.charts.load('current', {'packages': ['bar']});
    google.charts.setOnLoadCallback(drawCliques);
    google.charts.load('current', {'packages': ['bar']});
    google.charts.setOnLoadCallback(drawTipoEvento);
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawEstadoEvento);


    function drawGenero() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Gênero');
        data.addColumn('number', 'Usuários');
<?php foreach ($usuarios as $usuario) { ?>
            data.addRows([['<?= $usuario->genero ?>', <?= $usuario->num ?>]]);
<?php } ?>
        var options = {};
        var chart = new google.visualization.PieChart(document.getElementById('genero'));
        chart.draw(data, options);
    }

    function drawCliques() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Empresas');
        data.addColumn('number', 'Cliques');
<?php foreach ($cliques as $clique) { ?>
            data.addRows([['<?= $clique->empresa ?>', <?= $clique->num ?>]]);
<?php } ?>
        var options = {};
        var chart = new google.charts.Bar(document.getElementById('clique'));
        chart.draw(data, options);
    }

    function drawTipoEvento() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Tipo de Evento');
        data.addColumn('number', 'Eventos');
<?php foreach ($eventos as $evento) { ?>
            data.addRows([['<?= $evento->tipo ?>', <?= $evento->num ?>]]);
<?php } ?>
        var options = {};
        var chart = new google.charts.Bar(document.getElementById('tipo'));
        chart.draw(data, options);
    }

    function drawEstadoEvento() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Estado');
        data.addColumn('number', 'Eventos');
<?php foreach ($eventos2 as $evento2) { ?>
            data.addRows([['<?= $evento2->estado ?>', <?= $evento2->num ?>]]);
<?php } ?>
        var options = {};
        var chart = new google.visualization.PieChart(document.getElementById('estado'));
        chart.draw(data, options);
    }
</script>

<main>
    <section>
        <div class="row-plus"> 
            <div class="col-12">
                <h1>Dashboard</h1><br>
            </div>
            <div class="col-12">
                <h2>Relatórios</h2><br>
            </div>
            <div class="col-3">
                <button class="btListas"><a href="<?= base_url('admin/dashboard/relatorio_usuarios') ?>">
                        Usuários</a></button><br><br>
            </div>
            <div class="col-3">
                <button class="btListas"><a href="<?= base_url('admin/dashboard/relatorio_eventos') ?>">
                    Eventos</a></button><br><br>
            </div>
            <div class="col-3">
                <button class="btListas"><a href="<?= base_url('admin/dashboard/relatorio_categorias') ?>">
                    Categorias</a></button><br><br>
            </div>
            <div class="col-3">
                <button class="btListas"><a href="<?= base_url('admin/dashboard/relatorio_cliques') ?>">
                    Cliques em Anúncios</a></button><br><br>
            </div>
            <div class="col-12">
                <h2>Gráficos</h2><br>
            </div>
            <div class="col-5">
                <h3>Usuários ativos por gênero</h3>
                <div id="genero" style="width:100%;height:20em"></div><br><br>
            </div>            
            <div class="col-7">
                <h3>Cliques em anúncios ativos por empresa</h3>
                <div id="clique" style="width:100%;height:20em"></div><br><br>
            </div>            
            <div class="col-5">
                <h3>Eventos ativos por estado</h3>
                <div id="estado" style="width:100%;height:20em"></div><br><br>
            </div>
            <div class="col-7">
                <h3>Eventos ativos por tipo</h3>
                <div id="tipo" style="width:100%;height:20em"></div><br><br>
            </div>            
        </div>         
        </div>
    </section>    
</main>