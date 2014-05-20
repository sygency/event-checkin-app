$(document).ready(function () {
    $('#app-tickets-table').dataTable();

    // check in button click
    $('.app-check-in').click(function () {
        var ticketId = $(this).data('ticket-id'),
            container = $(this).closest('tr');

        $.post(TedXEvents.Config.baseUrl + 'guest_list/check_in', { ticket_id: ticketId })
            .done(function (response) {
                $('.app-check-in', container).hide();
                $('.app-check-out', container).removeClass('hide').show();
            });
    });

    // check out button click
    $('.app-check-out').click(function () {
        var ticketId = $(this).data('ticket-id'),
            container = $(this).closest('tr');

        $.post(TedXEvents.Config.baseUrl + 'guest_list/check_out', { ticket_id: ticketId })
            .done(function (response) {
                $('.app-check-out', container).hide();
                $('.app-check-in', container).removeClass('hide').show();
            });
    });

    // update visible tickets
    setInterval(function() {
        var ticketIds = [];
        $('.app-check-out:visible, .app-check-in:visible').each(function() {
            ticketIds.push($(this).data('ticket-id'));
        });

        $.post(TedXEvents.Config.baseUrl + 'guest_list/update', { ticket_ids: ticketIds })
            .done(function (response) {
                $.each(response, function(id, status) {
                    if (status) {
                        $('.app-check-out[data-ticket-id="' + id + '"]').removeClass('hide').show();
                        $('.app-check-in[data-ticket-id="' + id + '"]').hide();
                    } else {
                        $('.app-check-in[data-ticket-id="' + id + '"]').removeClass('hide').show();
                        $('.app-check-out[data-ticket-id="' + id + '"]').hide();
                    }
                });
            });
    }, 2000);
});
