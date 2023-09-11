<template>

    <ChatLayout>

        <!--  Контакты  -->
        <template v-slot:navbar>
            <NavBar :users="getUsers" :me="me"/>
        </template>

        <!--  Контакты  -->
        <template v-slot:contacts>
            <Contacts :users="sortedAndSearchUsers" :me="me" :getSecondUser="getSecondUser" />
        </template>

        <!--  С кем переписка-->
        <template v-slot:secondUserInfoBlock>
            <SecondUserInfoBlock :getSecondUser="getSecondUser"/>
        </template>

        <!--  Сообщения  -->
        <template v-slot:messages>
            <Messages :users="users" :me="me"/>
        </template>

        <!--  Отправка Сообщений -->
        <template v-slot:sendMessage>
            <SendMessageBlock :users="users" :me="me"/>
        </template>

    </ChatLayout>

</template>

<script>
import {mapActions, mapGetters,mapMutations} from 'vuex';
import {Link} from '@inertiajs/vue3'
import Contacts from "@/Components/Work/Contacts.vue";
import SecondUserInfoBlock from "@/Components/Work/SecondUserInfoBlock.vue";
import Messages from "@/Components/Work/Messages.vue";
import SendMessageBlock from "@/Components/Work/SendMessageBlock.vue";
import ChatLayout from "@/Layouts/Work/ChatLayout.vue";
import NavBar from "@/Components/Work/NavBar.vue";
export default {
    name: "Index",
    components:{NavBar, ChatLayout, SendMessageBlock, Messages, SecondUserInfoBlock, Contacts, Link},
    props: {
        users: {type: Array},
        me: {type: Object},
        notifications:{type:Array},
    },

    computed: {
        ...mapGetters({
            getSecondUser: 'work/getSecondUser',
            getChat_id: 'work/getChat_id',
            getUsers: 'notifyModule/getUsers',
            getNotifications: 'notifyModule/getNotifications',
            getMessages: 'work/getMessages',
            sortedAndSearchUsers:'notifyModule/sortedAndSearchUsers'
        }),

    },

    methods: {
        ...mapActions({
            addMessageToArrayList: 'work/addMessageToArrayList',
        }),

        ...mapMutations({
            setUsers: 'notifyModule/setUsers',
            setNotifications: 'notifyModule/setNotifications',
            setMessagesChatId: 'work/setMessagesChatId',
        })
    },

    watch: {
        getChat_id: {
            handler(newVal) {
                this.setMessagesChatId(newVal);
                window.Echo.channel('rooms_message_' + newVal)
                    .listen('.rooms_message', res => {
                        if (this.getMessages.chat_room == newVal){
                            this.addMessageToArrayList(res.message);
                        }
                    });
            },
            deep: true,
        },
    },


    mounted() {
        this.setNotifications(this.notifications);
        this.setUsers(this.users);
    }

}
</script>

<style scoped>
.content-message{
    height: 70vh;
}
</style>
