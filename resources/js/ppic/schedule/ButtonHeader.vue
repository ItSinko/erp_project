<template>
  <div class="btn-group">
    <button class="btn btn-primary" v-on:click="calendarClick">Kalender</button>
    <button class="btn btn-info" v-on:click="tableClick">Tabel</button>
    <!-- <button type="button" data-view="list" class="btn btn-warning">Daftar</button> -->
  </div>
</template>

<script>
export default {
  methods: {
    calendarClick() {
      this.$emit("view", "calendar");
    },

    tableClick() {
      this.$emit("view", "table");
    },
  },
};
</script>
