<template>

    {{getNotificationPusher}} <br>
    {{getSecondUser}}

    <div class="col-lg-4 mb-4">
        <div class="card h-100 overflow-auto overflow-x-hidden mb-5 mb-lg-0 content-message">
            <div class="card-body p-2" v-if="users">
                <div v-for="user in users" :key="user.id" class="mb-2">

                    <div v-if="user.id !== me.id">
                        <a href="#"
                           :class="user.id === getSecondUser.id ? 'd-block p-2 rounded-lg bg-gradient-primary' : 'd-block p-2 rounded-lg'"
                           @click.prevent="getChatRoom({me:me,secondUser:user})">
                            <div class="d-flex p-2">
                                <img alt="Image"
                                     src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzH6TfTtq91hzmeIvm_4JOdb5y1UWjTlYZdA&usqp=CAU"
                                     class="avatar shadow">
                                <div class="ml-2">
                                    <div class="justify-content-between align-items-center">
                                        <h4 :class="user.id === getSecondUser.id ?'mb-0 mt-1 text-white' : 'mb-0 mt-1'">
                                            {{ user.name }}<span
                                            v-if="getNotificationPusher.from_id === user.id || user.notificate"
                                            class="badge badge-danger ml-5">new</span>
                                        </h4>
                                        <p :class="user.id === getSecondUser.id ? 'text-white mb-0 text-xs font-weight-normal' : 'text-black-50 mb-0 text-xs font-weight-normal'">
                                            {{ user.email }}</p>
                                        <p>{{ user }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
//  getChatRoom -- Вся переписка с выбранным пользователем
import {mapActions, mapGetters, mapMutations} from 'vuex';

export default {
    name: "Contacts",
    props: {
        users: {type: Array, required: true},
        me: {type: Object, required: true},
        getSecondUser: {type: Object, required: true},
    },

    methods: {
        ...mapActions({
            getChatRoom: 'work/getChatRoom',
        }),

        ...mapMutations({
            setNotificationPusher: 'notifyModule/setNotificationPusher'
        })
    },

    computed: {
        ...mapGetters({
            getNotificationPusher: 'notifyModule/getNotificationPusher',
        })
    },


    mounted() {
        window.Echo.channel('notify_' + this.me.id)
            .listen('.notify', res => {
                if (this.getSecondUser.id !== res.from_id){
                    this.setNotificationPusher(res)
                }
            });
    }
}
</script>

<style scoped>

</style>
