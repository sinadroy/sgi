
var form = {
    view: "form",
    id: "idformLogin",
    borderless: true,
    elements: [
        { view: "text", label: 'Usu&aacute;rio', name: "login" },
        { view: "text", label: 'Senha', name: "senha", type: "password" },
        {
            view: "button", value: "Entrar", hotkey: "enter", click: function () {
                if (this.getParentView().validate()) { //validate form
                    var r = webix.ajax().sync().post(BASE_URL + "cutilizadores/validar", "action=login&login=" + $$("idformLogin").getValues().login + "&senha=" + $$("idformLogin").getValues().senha);
                    if (r.responseText == "true") {
                        this.getTopParentView().hide(); //hide window
                        var redirect = BASE_URL + 'welcome/principal';
                        window.location = redirect;
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
                $$("idformLogin").clear();
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
function showForm(winId, node) {
    $$(winId).getBody().clear();
    $$(winId).show(node);
    $$(winId).getBody().focus();
}

webix.ui({
    //view:"window",
    view: "popup",
    id: "winLoginSGI",
    width: 300,
    position: "center",
    modal: false,
    head: "Dados de Usu&aacute;rio",
    //body:webix.copy(form)
    body: form
});