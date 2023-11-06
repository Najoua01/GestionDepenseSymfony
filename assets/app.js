/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// Importez FullCalendar et les plugins dont vous avez besoin
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';


document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var formUrl = calendarPath.replace('DATE_TO_BE_REPLACED', currentDateString);

    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        events: [
            // Vos événements ici
        ],
        dateClick: function (info) {
            var dateStr = info.dateStr;
            formUrl = formUrl.replace('DATE_TO_BE_REPLACED', dateStr);
            window.location.href = formUrl;
        },
    });

    calendar.render();
});
