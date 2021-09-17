<template>
  <div class="col-md-3">
    <div class="card">
      <div class="card-header">
        <h5 class="text-center">Daftar Produksi</h5>
      </div>
      <div class="card-body table-responsive" style="height: 500px">
        <b-table striped hover :items="items"></b-table>
      </div>
    </div>
    

    <div v-if="status == 'penyusunan'">
      <button
        v-if="konfirmasi == 0"
        class="btn btn-block btn-info"
        v-on:click="sendConfirmation"
      >
        Konfirmasi
      </button>
      <button
        v-if="konfirmasi == 1"
        class="btn btn-block btn-danger"
        v-on:click="cancelConfirmation"
      >
        Batal konfirmasi
      </button>
      <button
        v-if="konfirmasi == 2"
        class="btn btn-block btn-success"
        v-on:click="sendBppb"
      >
        Kirim BPPB
      </button>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: {
    events: Array,
    status: String,
    konfirmasi: Number,
  },

  data: function () {
    return {
      confirmation: this.konfirmasi,
    };
  },

  computed: {
    items: function () {
      return this.events.map((item) => ({
        "Nama Produk": item.detail_produk.nama,
        "Jumlah Produksi": item.jumlah_produksi,
      }));
    },
  },

  methods: {
    sendConfirmation() {
      this.confirmation = 1;
      this.$emit("change-confirmation", this.confirmation);
    },

    cancelConfirmation() {
      this.confirmation = 0;
      this.$emit("change-confirmation", this.confirmation);
    },

    sendBppb() {},
  },
};
</script>