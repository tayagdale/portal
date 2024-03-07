function getStatus(id) {
    if (id == 1) {
        return '<span class="badge bg-success">OPEN</span>';
    } else if (id == 2) {
        return '<span class="badge bg-danger">CLOSED</span>';
    } else if (id == 3) {
        return '<span class="badge bg-black">CANCELLED</span>';
    } else {
        return '<span class="badge bg-info">DRAFT</span>';
    }
}


function getResStatus(id) {
    if (id == 1) {
        return '<span class="badge bg-success">RESERVED</span>';
    } else if (id == -1) {
        return '<span class="badge bg-black">CANCELLED</span>';
    } else {
        return '<span class="badge bg-info">ADDED TO ORDER</span>';
    }
}


function reloadDatatable(datatableClass) {
    $(`.${datatableClass}`).DataTable().ajax.reload();
}


function reloadDatatableWithUrl(datatableClass, url) {
    $(`.${datatableClass}`).DataTable().ajax.url(url).load();
}

