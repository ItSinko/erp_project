<template>
  <div>
    <div v-if="status == 'penyusunan'" class="alert alert-info">
      <h5><i class="icon fas fa-info"></i> Penyusunan</h5>
    </div>
    <div v-if="status == 'pelaksanaan'" class="alert alert-warning">
      <h5><i class="icon fas fa-hard-hat"></i> Pelaksanaan</h5>
    </div>
    <div v-if="status == 'selesai'" class="alert alert-success">
      <h5><i class="icon fas fa-check"></i> Selesai</h5>
    </div>

    <calendar-view
      v-if="view === 'calendar'"
      :events="dataEvent"
      :produks="JSON.parse(produks)"
      :status="status"
      v-on:update-event="updateEvent"
    />
    <table-view v-if="view === 'table'" :events="dataEvent" />
  </div>
</template>

<script>
import CalendarView from "./calendar/CalendarView.vue";
import TableView from "./table/TableView.vue";

export default {
  components: {
    CalendarView,
    TableView,
  },

  props: {
    events: String,
    status: String,
    produks: String,
    view: String,
  },

  data: function () {
    return {
      dataEvent: JSON.parse(this.events),
    };
  },

  methods: {
    updateEvent(data) {
      this.dataEvent = data;
    },
  },
};
</script>