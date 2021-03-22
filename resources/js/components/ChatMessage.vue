<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="header">
                <strong class="primary-font">
                    {{ message.user.nama }}
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
    props: ['messages']
};
</script>
