document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      defaultDate: '2019-08-12',
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
      select: function(start, end, allDay) {

      $('#new_schedule').modal('show');

      $('#apptStartTime').val(start);
      $('#apptEndTime').val(end);
      $('#apptAllDay').val(allDay);

        // if (title) {
        //   calendar.addEvent({
        //     title: title,
        //     start: arg.start,
        //     end: arg.end,
        //     allDay: arg.allDay
        //   })
        // }
        
        // calendar.unselect()

        // $('#formAddSchedule').submit(function (e) { 
        //   e.preventDefault();
        //   // if ($('input[name="title"]').val() != '') {
        //     calendar.addEvent({
        //       title:  $('input[name="title"]').val(),
        //       start: arg.start,
        //       end: arg.end,
        //       allDay: arg.allDay
        //     })
        //   // }

          
        
        //   calendar.unselect();

        //   $('#formAddSchedule').trigger("reset");
        //   $('#new_schedule').modal('hide');
        // });
        // calendar.unselect();
      },
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2019-08-01'
        },
        {
          title: 'Long Event',
          start: '2019-08-07',
          end: '2019-08-10'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2019-08-09T16:00:00'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2019-08-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2019-08-11',
          end: '2019-08-13'
        },
        {
          title: 'Meeting',
          start: '2019-08-12T10:30:00',
          end: '2019-08-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2019-08-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2019-08-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2019-08-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2019-08-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2019-08-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2019-08-28'
        }
      ]
    });

    calendar.render();

    $('#formAddSchedule').submit(function (e) { 
          e.preventDefault();
            
          new FullCalendar.Calendar(calendarEl, {
                title: $('input[name="title"]').val(),
                start: new Date($('#apptStartTime').val()),
                end: new Date($('#apptEndTime').val()),
                allDay: ($('#apptAllDay').val() == "true"),
            },
            true);


          $('#formAddSchedule').trigger("reset");
          $('#new_schedule').modal('hide');
    });

  });
    