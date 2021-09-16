<template>
  <div>
    <div style="margin-bottom: 20px">
      <label>Pilih Warna:</label>
      <button
        v-for="(color, name) in colors"
        :key="name"
        :class="name"
        v-on:click="handleClick"
        :style="{ padding: '20px', margin: '8px' }"
      ></button>
    </div>
    <div class="form-group">
      <label>Produk:</label>
      <select
        class="form-control"
        data-placeholder="Pilih produk"
        v-on:change="changeProduct"
        v-model="produkSelect"
      >
        <option v-for="produk in produks" :key="produk.id" :value="produk.id">
          {{ produk.nama }}
        </option>
      </select>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Versi BOM:</label>
        <select
          class="form-control"
          data-placeholder="Pilih versi BOM"
          v-on:change="changeBom"
          v-model="bomSelect"
        >
          <option v-for="bom in produkBom" :key="bom.id" :value="bom.id">
            {{ bom.versi }}
          </option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label>Jumlah Produk:</label>
        <input
          type="number"
          class="form-control"
          v-model="quantity"
          :max="maxQuantity"
        />
        <small
          :class="['form-text', quantityError ? 'text-danger' : 'text-muted']"
          >max: {{ maxQuantity }}</small
        >
      </div>
      <b-button
        class="mt-3"
        block
        :style="{ backgroundColor: color, borderColor: color }"
        v-on:click="handleSubmit"
        >Submit</b-button
      >
    </div>
  </div>
</template>

<script>
import axios from "axios";
import dateFormat from "dateformat";

export default {
  props: {
    produks: Array,
    startDate: Date,
    endDate: Date,
    status: String,
  },

  data: function () {
    return {
      produkSelect: "",
      bomSelect: "",
      quantity: 0,

      produkBom: [],
      maxQuantity: 0,
      color: "#6c757d",
      colors: {
        "btn btn-primary": "#007bff",
        "btn btn-secondary": "#6c757d",
        "btn btn-success": "#28a745",
        "btn btn-danger": "#dc3545",
        "btn btn-warning": "#ffc107",
        "btn btn-info": "#17a2b8",
      },

      quantityError: false,
    };
  },

  watch: {
    quantity: function (val) {
      if (val > this.maxQuantity) this.quantityError = true;
      else this.quantityError = false;
    },
  },

  methods: {
    handleClick(event) {
      this.color = this.colors[event.originalTarget.className];
    },

    changeProduct() {
      // console.log("/api/ppic/version-bom-product/" + this.produkSelect);
      axios
        .get("/api/ppic/version-bom-product/" + this.produkSelect)
        .then((response) => {
          this.produkBom = response.data.produk_bill_of_material;
          this.maxQuantity = 0;
          this.bomSelect = "";
          this.quantity = 0;
        });
    },

    changeBom() {
      axios
        .get("/api/ppic/get-max-quantity/" + this.bomSelect)
        .then((response) => {
          this.maxQuantity = response.data;
        });
    },

    handleSubmit() {
      if (!this.produkSelect || !this.bomSelect || !this.quantity) {
        alert("form tidak lengkap");
        return;
      }

      axios
        .post("/api/ppic/add-event", {
          detail_produk_id: this.produkSelect,
          produk_bill_of_material_id: this.bomSelect,
          jumlah_produksi: this.quantity,
          tanggal_mulai: dateFormat(this.startDate, "yyyy-mm-dd"),
          tanggal_selesai: dateFormat(this.endDate, "yyyy-mm-dd"),
          status: this.status,
          warna: this.color,
        })
        .then((response) => {
          let data = response.data;
          let data_last = data[data.length - 1];
          this.$emit("hide-product-modal", data, data_last);
        });
    },
  },
};
</script>