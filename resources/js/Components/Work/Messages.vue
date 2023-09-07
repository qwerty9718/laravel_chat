<template>
<!--    v-if="getChat_id === message.chat_room_id"-->
<!--    <div class="card-body overflow-auto overflow-x-hidden">-->
<!--        <div :class="message.user_id === me.id ? 'row justify-content-end text-right mb-1'  : 'row justify-content-start mb-1'" v-if="users" v-for="message in getMessages" :key="message.id">-->
<!--            <div class="col-auto" >-->
<!--                <div :class="message.user_id === me.id ? 'card bg-gradient-primary text-white' : 'card'">-->
<!--                    <div class="card-body p-2">-->
<!--                        <p>-->
<!--                            {{ message.body }}-->
<!--                        </p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div v-if="getStatus_chat === 'no chats'">-->
<!--            {{ getStatus_chat }}-->
<!--            <button class="btn btn-danger" @click="createNewChat({me:me,second_user:getSecondUser})">create-->
<!--                chat-->
<!--            </button>-->
<!--        </div>-->
<!--    </div>-->




    <div class="card-body overflow-auto overflow-x-hidden">
        <div :class="message.user_id === me.id ? 'row justify-content-end text-right mb-1'  : 'row justify-content-start mb-1'" v-if="users" v-for="message in getMessages.array" :key="message.id">
            <div class="col-auto" >
                <div :class="message.user_id === me.id ? 'card bg-gradient-primary text-white' : 'card'">
                    <div class="card-body p-2">
                        <p>
                            {{ message.body }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="getStatus_chat === 'no chats'">
            {{ getStatus_chat }}
            <button class="btn btn-danger" @click="createNewChat({me:me,second_user:getSecondUser})">create
                chat
            </button>
        </div>
    </div>


</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "Messages",

    props: {
        users: {type: Array},
        me: {type: Object},
    },
    computed: {
        ...mapGetters({
            getSecondUser: 'work/getSecondUser',
            getMessages: 'work/getMessages',
            getStatus_chat: 'work/getStatus_chat',
            getChat_id: 'work/getChat_id',
        }),
    },

    methods: {
        ...mapActions({
            createNewChat: 'work/createNewChat',
        }),
    },

}
</script>

<style scoped>

</style>
