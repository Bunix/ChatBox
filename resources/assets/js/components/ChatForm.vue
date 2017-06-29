<template>
    <div class="input-group">
        <input type="text" name="message" class="form-control input-sm" id="btn-input" placeholder="Start Typing..." v-model="newMessage" @keyup.enter="sendMessage">
        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                Send
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['user', 'conversationId', 'friendId'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage,
                    conversation_id: this.conversationId
                });

                this.newMessage = ''
            }
        }
    }
</script>