function cargarVistaDeclaracaoComNotas(itemID) {
    var f = new Date();
    //f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear()

    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Declaração Com Nota", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Imprimir", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdDeclaracaoComNotas").getSelectedId(false, true);
                                    //cargar dados necesarios para enviar para imprimir
                                    var record = $$("idDTEdDeclaracaoComNotas").getItem(idSelecionado);

                                    if (idSelecionado) {
                                        var envio = "id=" + idSelecionado +
                                            "&eid=" + record.eid +
                                            "&cnome=" + record.cnome +
                                            "&cnomes=" + record.cnomes +
                                            "&capelido=" + record.capelido +
                                            "&cbi_passaporte=" + record.cbi_passaporte +
                                            "&cBI_Data_Emissao=" + record.cBI_Data_Emissao +
                                            "&cBI_Lugar_Emissao_Provincia_id=" + record.cBI_Lugar_Emissao_Provincia_id +
                                            "&acnome=" + record.acnome +
                                            "&nnome=" + record.nnome +
                                            "&curso=" + record.curso +
                                            "&pnome=" + record.pnome +
                                            "&mnome=" + record.mnome +
                                            "&tipo_documentos_id=" + record.tipo_documentos_id;
                                        var r = webix.ajax().sync().post(BASE_URL + "Csecretaria_declaracao_com_notas/imprimir", envio);
                                        if (r.responseText == "true") {
                                            webix.message("PDF criado com sucesso");
                                            //Carregar PDF
                                            webix.ui({
                                                view: "window",
                                                id: "idWinPDFDSN",
                                                height: 600,
                                                width: 700,
                                                left: 50, top: 50,
                                                move: true,
                                                modal: true,
                                                //head:"This window can be moved",
                                                head: {
                                                    view: "toolbar", cols: [
                                                        { view: "label", label: "Declaração sem notass" },
                                                        { view: "button", label: 'X', width: 50, align: 'right', click: "$$('idWinPDFDSN').close();" }
                                                    ]
                                                },
                                                body: {
                                                    //template:"Some text"
                                                    template: '<div id="idPDFDSN" style="width:690px;  height:590px"></div>'
                                                }
                                            }).show();
                                            PDFObject.embed("../../relatorios/secretaria_declaracao_com_nota.pdf", "#idPDFDSN");

                                            $$("idDTEdDeclaracaoComNotas").clearAll();
                                            $$("idDTEdDeclaracaoComNotas").load(BASE_URL + "Cdocumentos_pendientes/read_com_notas");

                                        } else {
                                            webix.message({ type: "error", text: "Erro ao criar o pdf" });
                                        }

                                    } else {
                                        webix.message({ type: "error", text: "Deve selecionar um record" });
                                    }
                                }
                            },
                            {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdDeclaracaoComNotas").clearAll();
                                    $$("idDTEdDeclaracaoComNotas").load(BASE_URL + "Cdocumentos_pendientes/read_com_notas");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdDeclaracaoComNotas",
                            select: true,
                            editable: false,
                            columns: [
                                { id: "eid", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "cBI_Data_Emissao", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "cBI_Lugar_Emissao_Provincia_id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "acnome", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "mnome", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "tipo_documentos_id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },

                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },

                                { id: "nnome", header: ["N&iacute;vel", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "curso", header: ["Curso", { content: "textFilter" }], width: 300, sort: "string" },
                                { id: "pnome", header: ["Per&iacute;odo", { content: "textFilter" }], width: 100, sort: "string" },

                                { id: "cnome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "cnomes", header: "Nomes", width: 170, sort: "string" },
                                { id: "capelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "cbi_passaporte", editor: "text", header: ["BI-Pass.", { content: "textFilter" }], width: 150, sort: "strig" },

                            ],
                            resizeColumn: true,
                            //save: BASE_URL + "Cdocumentos_pendientes/crud",
                            url: BASE_URL + "Cdocumentos_pendientes/read_com_notas",
                            pager: "pagerDocumentos_Pendientes_CN"
                        }, {
                            view: "pager", id: "pagerDocumentos_Pendientes_CN",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }
        ]
    });
}
