<template>
    <div>
        <div class="card py-6 px-6">
            <div class="flex mt-6 mb-6" v-if="! Array.isArray(items_id)">
              <select class="form-control form-select rounded-r-none"
                      @change="onChange($event)"
                      v-model="customCommand.prop_id"
              >
                <option value="100" selected="selected">100 montaditos</option>
                <option :value="key" v-for="label,key in items_id">{{ label }}</option>
              </select>
              <!--      <input type="text" v-model="customCommand.command" placeholder="Enter a Command..." class="w-full form-control form-input form-input-bordered mr-2 rounded-l-none">-->
              <!--      <input type="text" placeholder="Enter a Command..." class="w-full form-control form-input form-input-bordered mr-2 rounded-l-none">
                    <button type="button" class="items-right btn btn-default btn-primary" @click="runCustomCommand">Run</button>-->
            </div>
            <FullCalendar ref="fullCalendar" :options="calendarOptions" />
        </div>
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

  return coloursString[Math.floor(Math.random() * coloursString.length)];
}

export default {
    components: {
        FullCalendar,
        EventModal
    },
    data() {
        return {
            calendarOptions: {
                // events: '/nova-vendor/nova-lite-calendar-tool/events',
                events: {
                  url: '/nova-vendor/nova-lite-calendar-tool/events',
                  extraParams: {
                    itemPropId: '47'
                  },
                  failure: function() {
                    alert('there was an error while fetching events!');
                  }
                },
                plugins: [ dayGridPlugin, timeGridPlugin, interactionPlugin ],
                initialView: 'dayGridMonth',
                locale: Nova.config.fullcalendar_locale || 'en',
                eventClick: this.handleEventClick,
                // eventColor: randomColour(),
                eventColor: '#960b57',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,monthGridYear'
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
            customCommand : {
              prop_id : ''
            }
        }
    },
    methods: {
        onChange(event) {
          console.log('onChange');
          console.log(event.target.value);
        },
        runCustomCommand() {
          console.log('runCustomCommand');
          this.$emit('refreshEvents');
          /*if(!this.customCommand.command){
            this.$toasted.show('Please enter a command', {type: 'error'});
            return;
          }*/
          /*this.openModal( this.customCommand );*/
        },
        handleEventClick(event) {
          if (event.url) {
            // window.open(event.url, '_blank');
            window.open(event.url, '_blank').focus();
            return false;
          }
        },
        refreshEvents() {
            console.log('refreshEvents');
            this.$refs.fullCalendar.getApi().refetchEvents();
        },
    },
}
</script>

<style>
</style>
