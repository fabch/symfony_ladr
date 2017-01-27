$(function () {
    $('#calendar-holder').fullCalendar({
        lang:'fr',
        header: {
            left: 'prev, next',
            center: 'title',
            right: 'month, agendaWeek, agendaDay,'
        },
        editable: true,
        droppable: true,
        drop: function (date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            copiedEventObject.backgroundColor = $(this).css("background-color");
            copiedEventObject.borderColor = $(this).css("border-color");

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar-holder').fullCalendar('renderEvent', copiedEventObject, true);

            $(this).remove();

        },
        weekNumbers:true,
        weekends: false,
        minTime:'8:00:00',
        maxTime:'19:00:00',
        events: [
            {
                start: '12:00:00',
                end: '14:00:00',
                color: 'gray',
                rendering: 'background',
                dow: [1,2,3,4,5]
            }
        ]

    });
});
