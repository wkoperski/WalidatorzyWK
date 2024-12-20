function changeValueModal(e)
{
    let title = document.querySelector(".modal-title");
    let placeholder = document.querySelector("#message-text")
    let action = document.querySelector("#action")
    let guid = document.querySelector("#guid")

    switch (e.name)
    {
        case "delete":
            title.innerHTML = 'Powód odrzucenia zgłoszenia';
            placeholder.placeholder = 'Proszę wskazać powód odrzucenia';
            action.name = 'delete';
            guid.value = e.value;
            break;
        case "add":
            title.innerHTML = 'Powód dodania na listę wiarygodnych';
            placeholder.placeholder = 'Proszę określić, dlaczego jest dodawany na listę mimo nie spełnienia kryteriów';
            action.name = 'add';
            guid.value = e.value;
            break;
        case "add_correct":
            placeholder.required = false;
            action.name = 'add';
            guid.value = e.value;
            break;

    }
}