<template>
  <div>
    <div class="card">
      <apexchart
        type="rangeBar"
        height="200"
        :options="options"
        :series="series"
      ></apexchart>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    events: Array,
  },

  computed: {
    series: function () {
      return [
        {
          data: this.events.map((event) => ({
            x: event.detail_produk.nama,
            y: [
              new Date(event.tanggal_mulai).getTime(),
              new Date(event.tanggal_selesai).getTime(),
            ],
          })),
        },
      ];
    },
  },

  data: function () {
    return {
      options: {
        plotOptions: {
          bar: {
            horizontal: true,
          },
        },
        xaxis: {
          type: "datetime",
        },
      },
    };
  },
};
</script>