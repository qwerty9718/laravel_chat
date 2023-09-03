<template>
    <div>
        {{ currentChat }}
        <div>
            <h2>{{ me.email }} {{ me.id }}</h2>

            <h2>Chats</h2>
            <div v-if="chat_room.length > 0">
                <div v-for="chat in chat_room" :key="chat.id">
                    <button style="color: red" @click="getChatRoom(chat.id)">{{ chat.name }}</button>
                </div>
            </div>
        </div>


        <div style="margin-top: 30px; margin-bottom: 30px">
            <h1>Send Message</h1>
            <input type="text" v-model="body" @update:model-value="setBody">
            <button @click="sendMessage({me_id:me.id,chat_room_id:currentChat})" style="color: red">send message
            </button>
        </div>


        <h2>Messages</h2>
        <div v-if="messages.length > 0" style="margin-top: 150px">

            <div v-for="user in users" :key="user.id">
                <div :class="me.id !== user.id ? 'message_left' : null">{{ user.email }}</div>
            </div>
            <div v-for="message in messages" :key="message.id">
                <div :class="me.id !== message.user_id ? 'message_left' : null">{{ message.body }}</div>
            </div>

        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3';
import {mapActions, mapGetters, mapMutations, mapState} from 'vuex';

export default {
    name: "MyPage",
    components: {Link},
    props: {
        me: {type: Object},
        chat_room: {type: Object}
    },


    watch:{

        currentChat: {
            handler(newVal) {
                window.Echo.channel('rooms_message_'+newVal)
                    .listen('.rooms_message', res => {
                        this.addMessageToArrayList(res.message);
                    })
            },
            deep: true,
        },
    },

    computed: {
        ...mapGetters({
            messages: 'message/getMessages',
            users: 'message/getUsers',
            currentChat: 'message/getCurrentChat',
            getBody: 'message/getBody',
        }),

        ...mapState({
            body: state => state.message.body
        }),

    },


    methods: {

        ...mapActions({
            getChatRoom: 'message/getChatRoom',
            sendMessage: 'message/sendMessage',
            addMessageToArrayList: "message/addMessageToArrayList"
        }),

        ...mapMutations({
            setBody: 'message/setBody'
        }),


    },


}
</script>

<style scoped>
.message_left {
    margin-left: 600px;
}
</style>
