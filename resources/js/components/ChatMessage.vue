<template>
  <ul class="chat">
    <li class="lefy clearfix" v-for="message in messages" :key="message.id">
      <div class="header">
        <strong class="primary-font">
          {{ message.user.name }}
        </strong>
      </div>
      <p>
        {{ message.message }}
      </p>
    </li>
  </ul>
</template>

<script>
export default {
  props: ["message"],
};
</script>