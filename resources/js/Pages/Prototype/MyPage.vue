<template>
    <div>
        {{currentChat}}
        <div>
            <h2>{{me.email}} {{me.id}}</h2>

            <h2>Chats</h2>
            <div v-if="chat_room.length > 0">
                <div v-for="chat in chat_room" :key="chat.id">
                    <button style="color: red" @click="getChatRoom(chat.id)">{{chat.name}}</button>
                </div>
            </div>
        </div>


        <div style="margin-top: 30px; margin-bottom: 30px">
            <h1>Send Message</h1>
            <input type="text" v-model="body">
            <button @click="sendMessage(me.id,currentChat)" style="color: red">send message</button>
        </div>


        <h2>Messages</h2>
            <div v-if="messages.length > 0" style="margin-top: 150px">

                <div v-for="user in users" :key="user.id">
                    <div :class="me.id !== user.id ? 'message_left' : null">{{user.email}}</div>
                </div>
                <div v-for="message in messages" :key="message.id">
                    <div :class="me.id !== message.user_id ? 'message_left' : null">{{message.body}}</div>
                </div>

            </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3'
export default {
    name: "MyPage",
    components:{Link},
    props:{
        me:{type:Object},
        chat_room:{type:Object}
    },

    data(){
        return{
            messages: [],
            users: [],
            currentChat: null,
            body : ''
        }
    },


    mounted() {
        window.Echo.channel(`rooms_message_${this.currentChat}`)
            .listen('.rooms_message', res => {
                this.messages.push(res.message)
            })
    },


    methods:{
        async getChatRoom(id){
            this.currentChat = id;
            const response = await axios.get(`/chat-test/room/${id}`);
            this.messages = response.data.messages;
            this.users = response.data.users;
            // console.log(response.data)
        },


        async sendMessage(me_id, chat_room_id){
            const data = {body: this.body, user_id: me_id, chat_room_id: chat_room_id};
            this.body = '';
            const response = await axios.post('/chat-test/sendMessage',data);
            this.messages.push(response.data)
        }
    },


}
</script>

<style scoped>
.message_left{
    margin-left: 600px;
}
</style>
