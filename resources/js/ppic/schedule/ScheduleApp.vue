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

    <div>{{ konfirmasi }}</div>
    <div>test</div>

    <div v-if="dataUser.divisi_id != 3">
      <calendar-view
        v-if="view === 'calendar'"
        :events="dataEvent"
        :produks="dataProduk"
        :status="status"
        :konfirmasi="konfirmasi"
        v-on:change-confirmation="changeConfirmation"
        v-on:update-event="updateEvent"
      />
      <table-view v-if="view === 'table'" :events="dataEvent" />
    </div>
    <div v-if="dataUser.divisi_id == 3">
      <table-view :events="dataEvent" />
      <b-button block variant="success" v-on:click="changeConfirmation(2)" :disabled="konfirmasi == 2" >Setuju</b-button>
    </div>

    <notifications
      group="foo-css"
      :width="500"
      position="top center"
      :speed="500"
    />
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
    user: String,
  },

  data: function () {
    return {
      dataEvent: JSON.parse(this.events),
      dataProduk: JSON.parse(this.produks),
      dataUser: JSON.parse(this.user),

      konfirmasi: JSON.parse(this.events).length > 0 ? JSON.parse(this.events)[0].konfirmasi : 0,
    };
  },

  // computed: {
    
  // },

  methods: {
    updateEvent(data) {
      this.dataEvent = data;
    },

    changeConfirmation(data) {
      this.konfirmasi = data;
      axios
        .post("/api/ppic/update-confirmation", {
          confirmation: data,
        })
        .then(() => {
          this.konfirmasi = data;
          if (this.konfirmasi == 0){
            this.$notify({
            group: "foo-css",
            title: "Dibatalkan",
            text: "Permintaan untuk konfirmasi jadwal telah dibatalkan",
            type: "error",
          });
          }else if (this.konfirmasi == 1){
            this.$notify({
            group: "foo-css",
            title: "Berhasil",
            text: "Permintaan untuk konfirmasi jadwal berhasil dikirim",
            type: "success",
          });
          } else if (this.konfirmasi == 2){
            this.$notify({
            group: "foo-css",
            title: "Disetujui",
            text: "Jadwal telah disetujui",
            type: "info",
          });
          }
        });
    },
  },
};
</script>