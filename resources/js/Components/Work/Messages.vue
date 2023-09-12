<template>


    <div class="card-body overflow-auto overflow-x-hidden" id="my-messages">
        <div ref="observer" class="observer"></div>
        <div
            :class="message.user_id === me.id ? 'row justify-content-end text-right mb-1'  : 'row justify-content-start mb-1'"
            v-if="users" v-for="message in getMessages.array" :key="message.id">
            <div class="col-auto ">
                <div :class="message.user_id === me.id ? 'card bg-gradient-primary text-white' : 'card'" style="min-height: 40px">
                    <div class="card-body p-2">
                        <p style="text-align: center">
                            {{ message.body }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="getStatus_chat === 'no chats'">
            {{ getStatus_chat }}
            <button class="btn btn-primary" @click="createNewChat({me:me,second_user:getSecondUser})">create
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
            getPage: 'work/getPage',
            getLastPage: 'work/getLastPage',
            getLoader: 'work/getLoader',
        }),
    },

    methods: {
        ...mapActions({
            createNewChat: 'work/createNewChat',
            loadMore: 'work/loadMore'
        }),

        scrollToTheEnd() {
            let container = document.querySelector("#my-messages");
            let scrollHeight = container.scrollHeight;
            container.scrollTop = scrollHeight;
        },

    },

    updated() {
        if (this.getPage <= 1) {
            this.scrollToTheEnd();
        }
    },

    mounted() {
        const options = {
            rootMargin: '0px',
            threshold: 1.0
        }
        const callback = (entries, observer) => {
            if (entries[0].isIntersecting && this.getPage < this.getLastPage) {
                let container = document.querySelector("#my-messages");
                    container.scrollTop += 150;
                this.loadMore({page: this.getPage, chat_id: this.getChat_id});
            }
        };
        const observer = new IntersectionObserver(callback, options);
        observer.observe(this.$refs.observer);

    }
}
</script>

<style scoped>
.observer {
    height: 30px;
    /*background: red;*/
    margin-bottom: 100px;
}
</style>
