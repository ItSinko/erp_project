<template>
    <button
        type="button"
        class="btn btn-tool"
        data-toggle="tooltip"
        title="Contacts"
        data-widget="chat-pane-toggle"
        @click="reset()"
    >
        <i class="fas fa-comments"></i>

        <span class="badge badge-danger navbar-badge">{{ count }}</span>
    </button>
</template>

<script>
export default {
    data() {
        return {
            count: 0
        };
    },

    methods: {
        reset() {
            this.count = 0;
        }
    }
};
</script>
