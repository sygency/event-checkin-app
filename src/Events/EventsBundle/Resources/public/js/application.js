$(document).ready(function () {
    $('#app-tickets-table').dataTable();

    $('.app-check-in').click(function () {
        var ticketId = $(this).data('ticket-id'),
            container = $(this).closest('tr');

        $.post(TedXEvents.Config.baseUrl + 'guest_list/check_in', { ticket_id: ticketId })
            .done(function (response) {
                $('.app-check-in', container).hide();
                $('.app-check-out', container).removeClass('hide').show();
            });
    });

    $('.app-check-out').click(function () {
        var ticketId = $(this).data('ticket-id'),
            container = $(this).closest('tr');

        $.post(TedXEvents.Config.baseUrl + 'guest_list/check_out', { ticket_id: ticketId })
            .done(function (response) {
                $('.app-check-out', container).hide();
                $('.app-check-in', container).removeClass('hide').show();
            });
    });
});
