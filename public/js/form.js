document.querySelectorAll('form span[data-status]').forEach(function (elem) {
    elem.onclick = function () {
        let msg = '';
        switch (elem.dataset.status) {
            case 'work':
                msg = 'Вы действительно хотите изменить статус на приянто в работу?'
                break;
            case 'solved':
                msg = 'Вы действительно хотите изменить статус на выполнено?'
                break;
            case 'delete':
                msg = 'Вы действительно хотите удалить заявку?'
                break;
            case 'delete-category':
                msg = 'Вы действительно хотите удалить категорию?'
                break;
        }
        if (confirm(msg)) {
            elem.closest('form').submit();
        }
    }
})
