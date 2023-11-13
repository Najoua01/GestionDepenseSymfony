/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
// import './styles/app.css';

// Importez FullCalendar et les plugins dont vous avez besoin
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

import Vue from 'vue';
import App from './composants/calendrier_vue';

new Vue({
    el: '#app',
    render: h => h(App),
});

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
        
    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        events: [
            // Vos événements ici
        ],
        dateClick: function (info) {
            var dateStr = info.dateStr;
            var formUrl = '{{ path("depense", { "date": "DATE_TO_BE_REPLACED" }) }}';
            formUrl = formUrl.replace('DATE_TO_BE_REPLACED', dateStr);
            window.location.href = formUrl;
        },
    });

    calendar.render();
});
