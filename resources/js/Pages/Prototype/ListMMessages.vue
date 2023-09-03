<template>

    <div v-if="messages.length > 0" style="margin-top: 150px">

        <div v-for="user in users" :key="user.id">
            <div :class="me.id !== user.id ? 'message_left' : null">{{ user.email }}</div>
        </div>
        <div v-for="message in messages" :key="message.id">
            <div :class="me.id !== message.user_id ? 'message_left' : null">{{ message.body }}</div>
        </div>

    </div>

</template>

<script>
import {mapState,mapMutations,mapActions,mapGetters} from 'vuex';
export default {
    name: "ListMMessages",
    props: {chat_room_id: {type: Object},me:{type:Object}},

    mounted() {

        if (this.chat_room_id !== null) {
            window.Echo.channel('rooms_message_' + this.chat_room_id)
                .listen('.rooms_message', res => {
                    this.addMessageToArrayList(res.message);
                })
        }
    },

    methods:{
        ...mapActions({
            addMessageToArrayList:'message/addMessageToArrayList'
        })
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
}
</script>

<style scoped>

</style>
