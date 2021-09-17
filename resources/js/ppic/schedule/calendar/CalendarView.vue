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
    konfirmasi: Number,
  },

  components: {
    FullCalendar,
    ListCalendar,
  },

  methods: {
    updateEvent(data) {
      this.$emit("update-event", data);
    },

    changeConfirmation(data) {
      this.$emit("change-confirmation", data);
    },
  },
};
</script>
