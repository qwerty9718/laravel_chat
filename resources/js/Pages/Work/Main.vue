<template>
    <div class="container-fluid text-center">
        {{ getChat_id }}
        {{ getStatus_chat }}
        <div class="container"><h1>Messenger</h1> {{ me.email }} id: {{ me.id }}</div>

        <div class="row">
            <div class="col-4">
                <div class="container" v-if="users" v-for="user in users" :key="user.id">
                    <div class="container mb-2 mt-2 user-chat" v-if="user.id !== me.id">
                        <h2>Id : {{ user.id }}</h2>
                        <h2>Email : {{ user.email }}</h2>
                        <button class="btn btn-danger" @click="getChatRoom({me:me.id,secondUser:user.id})">get Chat-
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="container-fluid">

                    <div v-if="getStatus_chat === 'no messages'">{{ getStatus_chat }}</div>

                    <div v-if="getStatus_chat === 'no chats'">
                        {{ getStatus_chat }}
                        <button class="btn btn-success" @click="createNewChat({me:me,second_user:getSecondUser})">create
                            chat
                        </button>
                    </div>
                    <div>
                        <div v-for="message in getMessages" :key="message.id" class="message-item"
                             :class="message.user_id === me.id ? 'my_message' : ''">
                            <div>{{ message.body }}</div>
                        </div>
                    </div>

                    <div v-if="getChat_id && getStatus_chat !== 'no chats'" class="mt-5">
                        <input type="text" class="form-control w-50" v-model="body" @update:model-value="setBody">
                        <button class="btn btn-success" @click="sendMessage({user_id:me.id,chat_room_id:getChat_id})">
                            send message
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapMutations, mapState, mapActions, mapGetters} from 'vuex';

export default {
    name: "Main",
    props: {
        users: {type: Array},
        me: {type: Object}
    },

    computed: {
        ...mapGetters({
            getSecondUser: 'work/getSecondUser',
            getMessages: 'work/getMessages',
            getChat_id: 'work/getChat_id',
            getStatus_chat: 'work/getStatus_chat'
        }),

        ...mapState({
            body: state => state.work.body
        })
    },

    methods: {
        ...mapActions({
            getChatRoom: 'work/getChatRoom',
            createNewChat: 'work/createNewChat',
            sendMessage: 'work/sendMessage',
            addMessageToArrayList: 'work/addMessageToArrayList'
        }),
        ...mapMutations({
            setBody: 'work/setBody',
            setChat_id: 'work/setChat_id'
        })
    },


    watch: {

        getChat_id: {
            handler(newVal) {
                window.Echo.channel('rooms_message_' + newVal)
                    .listen('.rooms_message', res => {
                        this.addMessageToArrayList(res.message);
                    });
            },
            deep: true,
        },
    },

}
</script>

<style scoped>
.user-chat {
    border: 1px solid green;
    border-radius: 15px;
    padding: 10px 10px;
}

.message-item {
    border: 1px solid green;
    border-radius: 15px;
    padding: 10px 10px;
    width: 40%;
    margin-bottom: 10px;
}

.my_message {
    color: red;
    margin-left: 580px;
}
</style>
