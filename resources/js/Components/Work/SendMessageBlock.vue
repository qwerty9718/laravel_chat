<template>
    <div class="card-footer d-block" >
        <form class="align-items-center" v-if="getChat_id">
            <div class="input-group mb-3">
                <textarea v-model="body" @update:model-value="setBody" type="text" placeholder="Send" class="form-control" aria-label="Amount (to the nearest dollar)" style="max-height: 130px"></textarea>
                <div class="input-group-append">
                    <a href="#" class="input-group-text" @click.prevent="sendMessage({me_id:me.id,chat_room_id:getChat_id,second_user_id:getSecondUser.id})" style="background: #7c61e4">
                        <i class="fa fa-paper-plane text-white"></i>
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
.test{
    width: 80%;
}
</style>
