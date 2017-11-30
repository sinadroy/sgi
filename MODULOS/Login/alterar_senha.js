var user_actual = "";
var id_user_actual = "";
var form2 = {
    view: "form",
    id: "idformLogin2",
    borderless: true,
    elements: [
        { view: "text", label: 'Usu&aacute;rio', id: "id_text_user2", name: "login" },
        { view: "text", label: 'Senha', name: "senha", type: "password" },
        {
            view: "button", value: "Entrar", hotkey: "enter", click: function () {
                if (this.getParentView().validate()) { //validate form
                    var r = webix.ajax().sync().post(BASE_URL + "cutilizadores/validar", "action=login&login=" + $$("idformLogin2").getValues().login + "&senha=" + $$("idformLogin2").getValues().senha);
                    if (r.responseText == "true") {
                        this.getTopParentView().hide(); //hide window
                        user_actual = $$("id_text_user2").getValue();
                        //readXnome
                        var envio = "nome=" + $$("id_text_user2").getValue();
                        var runome = webix.ajax().sync().post(BASE_URL + "cutilizadores/readIDXnome", envio);
                        id_user_actual = runome.responseText;

                        $$("winLoginSGI3").show();
                        $$("id_text_user3").setValue(user_actual);
                        $$("id_text_idusuario3").setValue(id_user_actual);
                    } else {
                        webix.message({ type: "error", text: "Dados incorretos" });
                    }
                }
                else
                    webix.message({ type: "error", text: "Dados incorretos" });
            }
        },
        {
            view: "button", value: "Cancel", name: "cancel", type: "danger", click: function () {
                $$("idformLogin2").clear();
                this.getTopParentView().hide(); //hide window
            }
        }
    ],
    rules: {
        "senha": webix.rules.isNotEmpty,
        "login": webix.rules.isNotEmpty
    },
    elementsConfig: {
        labelPosition: "top",
    }
};

var form3 = {
    view: "form",
    id: "idformLogin3",
    borderless: true,
    elements: [
        { view: "text", label: 'id', hidden: true, id: "id_text_idusuario3", name: "uid" },
        { view: "text", label: 'Usu&aacute;rio', id: "id_text_user3", disabled: true, name: "login" },
        { view: "text", label: 'Nova Senha', name: "senha", id:"id_text_senha3", type: "password" },
        {
            view: "button", value: "Salvar", hotkey: "enter", click: function () {
                if (this.getParentView().validate()) { //validate form
                    var uid = $$("id_text_idusuario3").getValue();
                    //uid = $$("id_text_idusuario3").getValue();
                    var senha = $$("id_text_senha3").getValue();
                    if (uid && senha) { //validate form
                        var envio = "id=" + uid + "&uSenha=" + senha;
                        var r = webix.ajax().sync().post(BASE_URL + "cutilizadores/update_senha", envio);
                        if (r.responseText == "true") {
                            //var redirect = BASE_URL+'welcome/principal';
                            //window.location = redirect;
                            //$$("component_id").load("some/path/data.json");
                            this.getTopParentView().hide(); //hide window
                            webix.message("Dados actualizados com sucesso");
                            
                        } else {
                            webix.message({ type: "error", text: "Erro actualizando dados" });
                        }
                    }
                    else
                        webix.message({ type: "error", text: "Dados incorretos" });
                }
                else
                    webix.message({ type: "error", text: "Dados incorretos" });
            }
        },
        {
            view: "button", value: "Cancel", name: "cancel", type: "danger", click: function () {
                $$("idformLogin3").clear();
                this.getTopParentView().hide(); //hide window
            }
        }
    ],
    rules: {
        "senha": webix.rules.isNotEmpty,
        "login": webix.rules.isNotEmpty
    },
    elementsConfig: {
        labelPosition: "top",
    }
};

function showForm2(winId, node) {
    $$(winId).getBody().clear();
    $$(winId).show(node);
    $$(winId).getBody().focus();
}

webix.ui({
    //view:"window",
    view: "popup",
    id: "winLoginSGI2",
    width: 300,
    position: "center",
    modal: false,
    head: "Dados de Usu&aacute;rio",
    //body:webix.copy(form)
    body: form2
});

webix.ui({
    view: "window",
    title: "Alterar Senha",
    //view: "popup",
    id: "winLoginSGI3",
    width: 300,
    position: "center",
    modal: true,
    head: "Dados de Usu&aacute;rio",
    //body:webix.copy(form)
    body: form3
});