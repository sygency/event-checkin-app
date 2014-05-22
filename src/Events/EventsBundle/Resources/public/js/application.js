$(document).ready(function () {
    // check in button click
    $('.app-check-in').on('click', function () {
        var ticketId = $(this).data('ticket-id'),
            container = $(this).closest('tr');

        $.post(TedXEvents.Config.baseUrl + 'guest_list/check_in', { ticket_id: ticketId })
            .done(function (response) {
                $('.app-check-in', container).hide();
                $('.app-check-out', container).removeClass('hide').show();

                // add one from checked in count
                $('#app-checked-in-count').each(function() {
                    $(this).html(parseInt($(this).html()) + 1);
                });
            });
    });

    // check out button click
    $('.app-check-out').on('click', function () {
        var ticketId = $(this).data('ticket-id'),
            container = $(this).closest('tr');

        $.post(TedXEvents.Config.baseUrl + 'guest_list/check_out', { ticket_id: ticketId })
            .done(function (response) {
                $('.app-check-out', container).hide();
                $('.app-check-in', container).removeClass('hide').show();

                // subtract one from checked in count
                $('#app-checked-in-count').each(function() {
                    $(this).html(parseInt($(this).html()) - 1);
                });
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

    // update progress
    setInterval(function() {
        $.post(TedXEvents.Config.baseUrl + 'guest_list/progress')
            .done(function (response) {
                var percentage     = response['progress'],
                    ticketCount    = response['ticketCount'],
                    checkedInCount = response['checkedInTicketCount'];

                $('#app-check-in-progress').find('.progress-bar')
                    .attr('aria-valuenow', percentage)
                    .css('width', percentage + '%');
                $('#app-progress-percents').html(Math.floor(percentage) + '%');

                $('#app-checked-in-count').html(checkedInCount);
                $('#app-total-ticket-count').html(ticketCount);
            });
    }, 3000);

    var table = $('#app-tickets-table').DataTable({
        "dom": '<"tickets-table-top">rt<"tickets-table-bottom"li><"clearfix"><"tickets-table-pagination"p><"clearfix">',
    });

    $('#app-ticket-search').on('keyup', function () {
        table
            .search('"' + this.value + '"')
            .draw();
    });

    var width = $('#app-tickets-table_paginate').width();
    
    $('#app-tickets-table_paginate').css({
        width: width + 100,
        float: 'none'
    });
});
