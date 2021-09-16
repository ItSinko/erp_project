<template>
  <div class="row">
    <full-calendar
      :events="events"
      :produks="produks"
      :status="status"
      :konfirmasi="konfirmasi"
      v-on:update-event="updateEvent"
    />
    <list-calendar
      :events="events"
      :status="status"
      :konfirmasi="konfirmasi"
      v-on:change-confirmation="changeConfirmation"
    />
  </div>
</template>

<script>
import FullCalendar from "./FullCalendar.vue";
import ListCalendar from "./ListCalendar.vue";

export default {
  props: {
    events: Array,
    produks: Array,
    status: String,
  },

  data: function () {
    return {
      konfirmasi: this.events.length > 0 ? this.events[0].konfirmasi : -1,
    };
  },

  components: {
    FullCalendar,
    ListCalendar,
  },

  methods: {
    updateEvent(data) {
      alert("update-event");
      this.$emit("update-event", data);
    },

    changeConfirmation(data) {
      this.konfirmasi = data;
    },
  },
};
</script>
