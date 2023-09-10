<template>
    <!--    <div class="container">-->
<!--            <h2>Current page {{getPage}}</h2>-->
<!--            <h2>Last page {{getLastPage}}</h2>-->
    <!--        <h2>Chat_id {{getChat_id}}</h2>-->
    <!--        <h2>Second User {{getSecondUser.id}}</h2>-->
    <!--        <button class="btn btn-primary" @click="loadMore({page:getPage,chat_id:getChat_id})">load more</button>-->
    <!--    </div>-->

    <div class="card-body overflow-auto overflow-x-hidden" id="my-messages">
        <div ref="observer" class="observer"></div>
        <div
            :class="message.user_id === me.id ? 'row justify-content-end text-right mb-1'  : 'row justify-content-start mb-1'"
            v-if="users" v-for="message in getMessages.array" :key="message.id">
            <div class="col-auto ">
                <div :class="message.user_id === me.id ? 'card bg-gradient-primary text-white' : 'card'">
                    <div class="card-body p-2">
                        <p style="text-align: center">
                            {{ message.body }}
                        </p>
                        <div class="d-flex align-items-center justify-content-end text-sm opacity-6">
                            <i class="fa fa-check-double mr-1 text-xs" aria-hidden="true"></i>
                            <small>4:42pm</small>
                        </div>
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
            getPage: 'work/getPage',
            getLastPage: 'work/getLastPage',
            getLoader: 'work/getLoader'
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
