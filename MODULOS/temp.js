
var data_comunicados = [
    { "id": 1, "comTitulo": "The Shawshank Redemption", "data": "01/03/2016" },
    { "id": 2, "comTitulo": "The Shawshank Redemption", "data": "01/04/2016" },
    { "id": 3, "comTitulo": "The Shawshank Redemption", "data": "01/05/2016" },
    { "id": 4, "comTitulo": "The Shawshank Redemption", "data": "01/06/2016" },
    { "id": 5, "comTitulo": "The Shawshank Redemption", "data": "01/07/2016" },
    { "id": 6, "comTitulo": "The Shawshank Redemption", "data": "01/08/2016" },
    { "id": 7, "comTitulo": "The Shawshank Redemption", "data": "01/09/2016" },
    { "id": 8, "comTitulo": "The Shawshank Redemption", "data": "01/10/2016" },
    { "id": 9, "comTitulo": "The Shawshank Redemption", "data": "02/10/2016" },
    { "id": 10, "comTitulo": "The Shawshank Redemption", "data": "03/10/2016" }
];

//TEMPORAL PARA GRAFICA
var dataset_colors = [
    { id: 1, quantidade: 20, codigo: "ELMED", color: "#ee4339" },
    { id: 2, quantidade: 55, codigo: "EFM", color: "#ee9336" },
    { id: 3, quantidade: 40, codigo: "LCLI", color: "#eed236" },
    { id: 4, quantidade: 78, codigo: "PSIC", color: "#d3ee36" },
    { id: 5, quantidade: 61, codigo: "EIF", color: "#a7ee70" },
    { id: 6, quantidade: 35, codigo: "ELEC", color: "#58dccd" },
    { id: 7, quantidade: 80, codigo: "MECA", color: "#36abee" },
    { id: 8, quantidade: 50, codigo: "ARQ", color: "#476cee" },
    { id: 9, quantidade: 65, codigo: "IDRA", color: "#a244ea" },
    { id: 10, quantidade: 59, codigo: "ECIV", color: "#e33fc7" }
];
var month_dataset = [
    { quantidade: "300", periodo: "Regular", color: "#36abee" },
    { quantidade: "200", periodo: "Postlaboral", color: "#ee9e36" },
    //{quantidade: "20", periodo: "PostGrau", color: "#58dccd"}
];

/*
webix.ui({
    container: "item01",
    //type:"clear", id:"a1", autoWidth:true, autoHeight:true,
    rows: [
        {
            cols: [
                {
                    view: "button", value: "Anterior",
                    click: function () {
                        $$('pager1').select("prev");
                    }
                },
                {},
                {
                    view: "button", value: "Seguinte",
                    click: function () {
                        $$('pager1').select("next");
                    }
                }
            ]
        },
        {
            view: "list", data: data_comunicados, yCount: 5, select: true,
            type: {
                width: 400,
                height: 70,
                template: "<div class='overall'><div class='T&iacute;tulo'>#comTitulo#</div><div class='year'>Data: #data#</div> </div>"
            },
            pager: {
                apiOnly: true, id: "pager1", size: 5, animate: {
                    direction: "top"
                }
            }
        }
    ]
});



webix.ui({
    container: "item03",
    rows: [
        {
            view: "carousel",
            id: "carouselEstadisticas",
            width: 400,
            height: 330,
            navigation: {
                type: "side",
                items: true,
                buttons: true
            },
            cols: [
                //{css: "image", template:img, data:{src:PRO_URL+"resources/carrucel/image001.jpg", title: "Image 1"} },
                {
                    css: "image",
                    id: "chartEstXCurso",
                    view: "chart",
                    //width:600px;height:250px;
                    width: 410,
                    //autowidth: true,
                    height: 250,
                    type: "bar",
                    value: "#quantidade#",
                    label: "#quantidade#",
                    color: "#color#",
                    radius: 0,
                    barWidth: 40,
                    tooltip: {
                        template: "#quantidade#"
                    },
                    xAxis: {
                        title: "Estudantes por curso",
                        template: "'#codigo#",
                        lines: true
                    },
                    padding: {
                        left: 10,
                        right: 10,
                        top: 50
                    },
                    data: dataset_colors
                }, {
                    rows: [
                        {
                            css: "image",
                            view: "chart",
                            type: "pie",
                            autowidth: true,
                            //borderless:true,
                            border: true,
                            value: "#quantidade#",
                            color: "#color#",
                            label: "#periodo#",
                            pieInnerText: "#quantidade#",
                            shadow: 0,
                            data: month_dataset
                        }, {
                            template: "<div style='width:100%;text-align:center'>Estudantes por periodo</div>",
                            height: 30
                        }
                    ]
                }
            ]
        },
    ]
});
*/