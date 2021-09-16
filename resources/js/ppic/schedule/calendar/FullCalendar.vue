<template>
  <div class="col-md-9">
    <div class="card">
      <full-calendar
        ref="fullCalendar"
        id="calendar"
        :options="calendarOptions"
      />
      <b-modal ref="product-modal" title="Pilih Produk" hide-footer>
        <product-modal
          :produks="produks"
          :startDate="startDate"
          :endDate="endDate"
          v-on:hide-product-modal="handleSubmit"
        />
      </b-modal>

      <b-modal ref="delete-modal" title="Hapus Jadwal" hide-footer>
        <b-button size="sm" variant="success" @click="ok()"> OK </b-button>
        <b-button size="sm" variant="danger" @click="cancel()">
          Cancel
        </b-button>
      </b-modal>
    </div>
  </div>
</template>

<script>
import axios from "axios";

import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

import ProductModal from "./ProductModal.vue";

export default {
  props: {
    events: Array,
    produks: Array,
    status: String,
    konfirmasi: Number,
  },

  watch: {
    konfirmasi: function (newValue) {
      if (newValue == 0) this.enableEdit();
      else this.disableEdit();
    },
  },

  components: {
    FullCalendar,
    ProductModal,
  },

  mounted: function () {
    let api = this.$refs.fullCalendar.getApi();
    if (this.status == "penyusunan") {
      if (this.konfirmasi != 0) this.disableEdit();
      else this.enableEdit();
      api.next();
    }
    if (this.status == "pelaksanaan") {
      this.disableEdit();
    }
    if (this.status == "selesai") {
      this.disableEdit();
      api.prev();
    }
  },

  data: function () {
    return {
      startDate: Date(),
      endDate: Date(),

      publicId: 0,
      clickEvent: {},

      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin],

        locale: "id",
        headerToolbar: {
          end: "",
        },
        weekends: false,
        showNonCurrentDates: false,
        editable: true,
        selectable: true,

        events: this.getEvents(this.events),

        select: this.handleSelect,
        eventClick: this.handleEventClick,
      },
    };
  },

  methods: {
    convertData(event) {
      return {
        id: event.id,
        title: event.detail_produk.nama,
        start: event.tanggal_mulai,
        end: event.tanggal_selesai,
        backgroundColor: event.warna,
        borderColor: event.warna,
      };
    },

    getEvents(events) {
      if (events.length === 0) return [];
      return events.map((event) => this.convertData(event));
    },

    disableEdit() {
      this.calendarOptions.editable = false;
      this.calendarOptions.selectable = false;
    },

    enableEdit() {
      this.calendarOptions.editable = true;
      this.calendarOptions.selectable = true;
    },

    handleSelect(selectInfo) {
      let calendarApi = selectInfo.view.calendar;
      calendarApi.unselect(); // clear date selection

      this.startDate = selectInfo.start;
      this.endDate = selectInfo.end;

      this.$refs["product-modal"].show();
    },

    handleEventClick(clickInfo) {
      this.clickEvent = clickInfo;
      this.$refs["delete-modal"].show();
    },

    ok() {
      axios
        .post("/api/ppic/delete-event", {
          id: this.publicId,
        })
        .then((response) => {
          console.log(response.data);
          this.$emit("update-event", response.data);
          this.clickEvent.event.remove();
          this.$refs["delete-modal"].hide();
        })
        .catch((error) => {
          console.log(error);
        });
    },

    hide() {
      this.$refs["delete-modal"].hide();
    },

    handleSubmit(data, data_last) {
      this.$refs["fullCalendar"].getApi().addEvent(this.convertData(data_last));
      this.$refs["product-modal"].hide();
      this.$emit("update-event", data);
    },
  },
};
</script>


<style>
#calendar {
  padding: 20px;
}
</style>
