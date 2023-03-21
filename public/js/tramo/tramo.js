$(function ($) {
    $.ajaxSetup({
        headers: { "X-CSRF-Token": $("meta[name=csrf-token]").attr("content") },
    });

    $("#gridProductoss").bootstrapTable({
        url: ruta_list,
        classes: "table-striped",
        method: "get",
        contentType: "application/x-www-form-urlencoded",
        pagination: true,
        pageSize: 10,
        columns: [

            {
                field: "name",
                title: "Nombre",
                width: "26",
                widthUnit: "%",
            },
            {
                field: "type",
                title: "Tipo de producto",
                width: "26",
                widthUnit: "%",
            },
            {
                field: "product_families",
                formatter: "getFamily",
                title: "Famiia de producto",
                width: "26",
                widthUnit: "%",
            },
            {
                field: "description",
                title: "Descripción",
                width: "10",
                widthUnit: "%",
            },
            {
                formatter: "getIngredients",
                field: "ingredients",
                title: "Ingredientes",
                width: "10",
                widthUnit: "%",
            },

        ],
        onLoadSuccess: function (data) {
/*             console.log(data)
 */        },
    });
    $("#gridValuadores").bootstrapTable("refresh");
});

