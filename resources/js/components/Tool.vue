<template>
    <div>
        <div class="card py-6 px-6">
            <div class="flex mt-6 mb-6" v-if="! Array.isArray(itemsId)">
              <label class="inline-block text-80 pt-2 leading-tight pr-2">
                {{ itemsDropdownPlaceholder}}
              </label>
              <select class="form-control form-select"
                      @change="onChange($event)"
                      v-model="itemId"
              >
                <option value="" disabled>----</option>
                <option :value="key" v-for="label,key in itemsId">{{ label }}</option>
              </select>
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
                    itemSelectedId: ''
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
            itemId: null,
            itemsId: null,
            itemsDropdownPlaceholder: Nova.config.items_dropdown_placeholder
        }
    },
    methods: {
        onChange(event) {
          console.log('onChange');
          console.log(event.target.value);
          this.calendarOptions.events.extraParams.itemSelectedId = event.target.value;
          this.refreshEvents();
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
        getItemsForSelect() {
            Nova.request().get('/nova-vendor/nova-lite-calendar-tool/items')
                .then(response => {
                  this.itemsId = response.data;
                  /*console.log('itemsId');
                  console.log(this.itemsId);*/
                })
        }
    },
    mounted() {
      this.getItemsForSelect();
    }
}
</script>

<style>
</style>
