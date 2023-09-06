<template>
    <div class="card-footer d-block" v-show="getChat_id">
        <form class="align-items-center">
            <div class="input-group mb-3">
                <input v-model="body" @update:model-value="setBody" type="text" placeholder="Send" class="form-control" aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                    <a href="#" class="input-group-text" @click.prevent="sendMessage({me_id:me.id,chat_room_id:getChat_id,second_user_id:getSecondUser.id})">
                        <i class="fa fa-paper-plane"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import {mapActions, mapGetters, mapMutations, mapState} from "vuex";

export default {
    name: "SendMessageBlock",

    props: {
        users: {type: Array},
        me: {type: Object}
    },

    computed: {
        ...mapGetters({
            getSecondUser: 'work/getSecondUser',
            getChat_id: 'work/getChat_id',
        }),

        ...mapState({
            body: state => state.work.body
        })
    },

    methods: {
        ...mapActions({
            sendMessage: 'work/sendMessage',
        }),
        ...mapMutations({
            setBody: 'work/setBody',
        }),

    },
}
</script>

<style scoped>

</style>
