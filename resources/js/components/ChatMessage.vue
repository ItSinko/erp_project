<template>
    <ul class="chat">
        <div class="left clearfix" v-for="message in messages">
            <div
                :class="
                    compare(message.user.nama)
                        ? 'direct-chat-msg'
                        : 'direct-chat-msg right'
                "
            >
                <div class="direct-chat-infos clearfix">
                    <span
                        :class="
                            compare(message.user.nama)
                                ? 'direct-chat-name float-left'
                                : 'direct-chat-name float-right'
                        "
                        >{{ message.user.nama }}</span
                    >
                </div>
                <!-- /.direct-chat-infos -->
                <img
                    class="direct-chat-img"
                    v-bind:src="image"
                    alt="message user image"
                />
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    {{ message.message }}
                </div>
                <!-- /.direct-chat-text -->
            </div>
        </div>
    </ul>
</template>

<script>
export default {
    props: ["messages", "user"],

    data: function() {
        return {
            image: "/assets/image/user/index.png"
        };
    },

    methods: {
        compare(user) {
            return this.user.nama == user;
        }
    }
};
</script>
