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
                eventColor: '#960b57', // #80061c #d47486 #ab97e6
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
            this.showModal = false;
            this.currentEvent = event;
        },
        closeModal() {
            this.showModal = false;
            this.currentEvent = null;
            this.currentDate = null;
        },
        refreshEvents() {
            this.$refs.fullCalendar.getApi().refetchEvents();
        },
      randomColour() {
        var arr = ['#960b57', '#80061c', '#d47486', '#ab97e6'];

        return array[Math.floor(Math.random() * arr.length)];
      }
    },
}
</script>

<style>
</style>
