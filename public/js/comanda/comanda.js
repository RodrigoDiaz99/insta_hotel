$(function () {
    $.ajaxSetup({
        headers: { "X-CSRF-Token": $("meta[name=csrf-token]").attr("content") },
    });
    $('#modalCreateComanda').on('click', function () {
        keyRandom();
    });
    $("#btnGuardarComanda").on('click', function () {
        console.log("entrando 1")
        guardarComanda();
        $('#gridComandas').bootstrapTable('removeAll');
        $('#gridComandas').bootstrapTable('refresh');

    });

    /* Bootstrap table */
    $("#gridComandas").bootstrapTable({
        url: url_get_comandas,
        classes: "table-striped",
        method: "post",
        contentType: "application/x-www-form-urlencoded",
        pagination: true,
        pageSize: 10,
        detailView: true,
        columns: [{
            field: "id",
            title: "ID",
            visible: false,
        }, {
            field: "llave_comanda",
            title: "Key",
            visible: true,
        }, {
            field: "name",
            title: "Habitación",
            visible: true,
        }, {
            field: "cedicion",
            title: "Acciones",
            formatter: "editFormatter",
        }],
        onLoadSuccess: function (data) { },
        onExpandRow: function (index, row, $detail) {
            indexp = index;
            expandTable(row, $detail.html("<table class='table table-striped table-bordered' cellspacing='0'></table>").find("table"));
        },
    });
    /* Bootstrap table */

});

function editFormatter(value, row) {
    console.log(row.id);
    var html = '';
    html += '<a title="Editar Comanda" onclick="abrirModal(' + row.id + ')" type="button" class="btn btn-icon btn-success" data-toggle="modal" data-target="#editComanda-{{$row->id}}">    <i class="fas fa-edit"></i></a>'
    return html;
}

function abrirModal(id) {

    $('#editComanda').modal('show');
}

function keyRandom() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 10; i++) {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }

    console.log(text);


    $("#llave_comanda").val(text);

}

function guardarComanda() {
    console.log("entrando 2");
    let llave_comanda = $("#llave_comanda").val();
    let room_id = $("#room_id").val();
    console.log(llave_comanda);
    $.ajax({
        url: url_crear_comanda,
        type: "post",
        dataType: "json",
        data: {
            llave_comanda: llave_comanda,
            room_id: room_id,
        },
        async: true,
        cache: false,
        beforeSend: function () {
            swal.fire({
                title: "Aviso RPP",
                text: "Guardando información, Espere Por Favor...",
                onOpen: () => {
                    swal.showLoading();
                },
            });
            $("#addTramo").modal('hide');
            $("#llave_comanda").val("");
        },
        success: function (data) {
            swal.close();
            if (data.lSuccess) {
                swal.fire({
                    title: "Aviso RPP",
                    text: "Se genero la presolicitud. Podrá dar seguimiento a su pago en el listado de presolicitudes, igualmente ahí podrá visualizar el pedimento que se genera de manera automática. Posterior a la validación del pago podrá realizar la firma en el mismo listado.",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonClass: "btn btn-primary btn-round",
                    confirmButtonText: "Aceptar",
                    buttonsStyling: false,
                });
            } else {
                swal.fire({
                    title: "Aviso",
                    text: data.cMensaje,
                    type: "warning",
                    showConfirmButton: true,
                    confirmButtonClass: "btn btn-primary btn-round",
                    confirmButtonText: "Aceptar",
                    buttonsStyling: false,
                });
            }
        },
    });
}
