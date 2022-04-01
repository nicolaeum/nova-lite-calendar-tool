<template>
    <div>
        <div class="card py-6 px-6">
            <FullCalendar ref="fullCalendar" :options="calendarOptions" />
        </div>

        <transition name="fade">
            <EventModal
                v-if="showModal"
                :currentEvent="currentEvent"
                :currentDate="currentDate"
                @refreshEvents="refreshEvents"
                @close="closeModal"
                @confirm="saveEvent"
                @delete="deleteEvent"
            />
        </transition>
    </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import allLocales from '@fullcalendar/core/locales-all';
import EventModal from './EventModal';

function randomColour() {
  var coloursString = ['#960b57', '#80061c', '#d47486', '#ab97e6'];

  return coloursString[Math.floor(Math.random() * array.length)];
}

export default {
    components: {
        FullCalendar,
        EventModal
    },
    data() {
        return {
            calendarOptions: {
                events: '/nova-vendor/nova-lite-calendar-tool/events',
                plugins: [ dayGridPlugin, timeGridPlugin, interactionPlugin ],
                initialView: 'dayGridMonth',
                locale: Nova.config.fullcalendar_locale || 'en',
                dateClick: this.handleDateClick,
                eventClick: this.handleEventClick,
                eventColor: randomColour,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: false
                },
                timeFormat: 'H(:mm)'
            },
            currentEvent: null,
            currentDate: null,
            showModal: false
        }
    },
    methods: {
        handleDateClick(date) {
            this.showModal = false;
            this.currentDate = date;
        },
        handleEventClick(event) {
          alert('Event: ' + info.event.title);
          alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
          alert('View: ' + info.view.type);

          // change the border color just for fun
          info.el.style.borderColor = 'red';

          if (event.url) {
            window.open(event.url, "_blank");
            return false;
          }
        },
        closeModal() {
            this.showModal = false;
            this.currentEvent = null;
            this.currentDate = null;
        },
        refreshEvents() {
            this.$refs.fullCalendar.getApi().refetchEvents();
        },
    },
}
</script>

<style>
</style>
