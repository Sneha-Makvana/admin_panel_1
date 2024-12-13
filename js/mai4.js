// document.addEventListener('DOMContentLoaded', function() {
//     var calendarEl = document.getElementById('calendar1');
//     var calendar = new FullCalendar.Calendar(calendarEl, {
//         initialView: 'dayGridMonth',
//         events: {
//             url: 'get_bookings.php',
//             method: 'GET',
//             failure: function() {
//                 alert('There was an error while fetching events.');
//             }
//         },
//         headerToolbar: {
//             left: 'prev,next today',
//             center: 'title',
//             right: 'dayGridMonth,timeGridWeek,timeGridDay'
//         },
//         eventClick: function(info) {

//             var details = `
//                 <p><strong>Event Name:</strong> ${info.event.title}</p>
//                 <p><strong>Booking Date:</strong> ${info.event.start.toLocaleDateString()}</p>
//                 <p><strong>Customer Name:</strong> ${info.event.extendedProps.customerName}</p>
//                 <p><strong>Customer Email:</strong> ${info.event.extendedProps.customerEmail}</p>
//                 <p><strong>Customer Phone:</strong> ${info.event.extendedProps.customerPhone}</p>
//                 <p><strong>Customer City:</strong> ${info.event.extendedProps.customerCity}</p>
//             `;

//             var popup = document.createElement('div');
//             popup.id = 'event-popup';
//             popup.style.position = 'fixed';
//             popup.style.left = '50%';
//             popup.style.top = '50%';
//             popup.style.transform = 'translate(-50%, -50%)';
//             popup.style.background = '#fff';
//             popup.style.padding = '20px';
//             popup.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
//             popup.style.zIndex = '1000';
//             popup.innerHTML = details;

//             var closeButton = document.createElement('button');
//             closeButton.innerText = 'Close';
//             closeButton.style.marginTop = '10px';
//             closeButton.onclick = function() {
//                 popup.remove();
//             };
//             popup.appendChild(closeButton);

//             document.body.appendChild(popup);

//             info.jsEvent.preventDefault();
//         }
//     });

//     calendar.render();
// });


document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar1');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: {
            url: 'get_bookings.php',
            method: 'GET',
            failure: function () {
                alert('There was an error while fetching events.');
            }
        },
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        eventContent: function(arg) {
            let customHtml = `<div style="color: black; padding: px; border-radius: 5px;">${arg.event.title}</div>`;
            return { html: customHtml };
        },
        eventClassNames: function() {   
            return ['custom-event'];
        },
        eventClick: function (info) {
            document.getElementById('modalEventTitle').textContent = info.event.title;
            document.getElementById('modalCustomerName').textContent = info.event.extendedProps.customerName;
            document.getElementById('modalCustomerPhone').textContent = info.event.extendedProps.customerPhone;
            document.getElementById('modalBookingQty').textContent = info.event.extendedProps.bookingQty;
            document.getElementById('modalBookingTotal').textContent = info.event.extendedProps.bookingTotal;
            document.getElementById('modalEventLocation').textContent = info.event.extendedProps.eventLocation;
            document.getElementById('modalEventPrice').textContent = info.event.extendedProps.eventPrice;
            document.getElementById('modalEventCategory').textContent = info.event.extendedProps.eventCategory;
            document.getElementById('modalBookingDate').textContent = new Date(info.event.start).toLocaleDateString();

            var modal = new bootstrap.Modal(document.getElementById('eventDetailsModal'));
            modal.show();

            info.jsEvent.preventDefault();
        }
    });

    calendar.render();
});

