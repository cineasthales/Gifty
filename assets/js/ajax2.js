$(document).ready(function () {

    var path = "http://localhost/gifty/";

    $('#cep').blur(function () {
        $.ajax({
            url: 'http://cep.republicavirtual.com.br/web_cep.php?cep=' + $('#cep').val() + '&formato=json',
            datatype: 'json',
            success: function (data) {
                $('#logradouro').val(data.tipo_logradouro + ' ' + data.logradouro);
                $('#bairro').val(data.bairro);
                $('#cidade').val(data.cidade);
                $('#estado').val(data.uf);
                $('#numero').focus();
            }
        });
    });

});