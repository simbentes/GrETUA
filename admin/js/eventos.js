$('#tabelaeventos').DataTable({
    columnDefs: [
        {orderable: false, targets: 5}
    ],
    order: [[1, 'desc']],
    "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
    },
    dom: "<'row justify-content-end pb-3'<'col-md-auto text-end'B>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    buttons: [
        {
            extend: 'pdf',
            text: '<i class="fas fa-file-download pr-2"></i> Guardar PDF'
        }
    ]
});