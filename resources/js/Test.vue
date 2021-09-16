<template>
  <input
    type="checkbox"
    v-bind:checked="checked"
    v-on:change="$emit('change', $emit.target.checked)"
  />
</template>

<script>
export default {
  model: {
    prop: "checked",
    event: "change",
  },

  props: {
    checked: Boolean,
  },
};
</script>