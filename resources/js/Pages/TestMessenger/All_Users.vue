<template>
    <div>

        <div class="mb-5">
            <h1>Me {{this.$page.props.auth.user.email}}</h1>
            <h1>id : {{this.$page.props.auth.user.id}}</h1>
            <Link :href="route('chat.myPage',this.$page.props.auth.user.id)" style="color: red">Go to My Page</Link>
        </div>

        <div v-if="mess"> {{mess}} </div>
        <div v-if="like_str"><h1>{{like_str}}</h1></div>

        <div v-if="all_users">
            <div v-for="user in all_users">
                <div v-if="user.id !== this.$page.props.auth.user.id" class="mb-4">
                    <h2>{{user.id}}</h2>
                    <h2>{{user.name}}</h2>
                    <button @click="sendLike(user.id)" class=" mb-4 rounded-lg block w-20 bg-sky-400 text-white text-center py-2">Like</button>

                    <div>
                        <input type="text" v-model="my_message">
                        <button @click="sendMessage(user.id)" class=" mb-4 rounded-lg block w-20 bg-red-500 text-white text-center py-2">Send Message</button>
                    </div>

                    <hr class="mb-4">
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3'
export default {
    name: "All_Users",
    components:{Link},
    props:['all_users'],
    data(){
        return{
            like_str:'',
            my_message: '',
            mess: ''
        }
    },

    created() {
        window.Echo.private(`send_like_${this.$page.props.auth.user.id}`)
            .listen('.send_like', res => {
                this.like_str = res.like_str
            });

        window.Echo.private(`send_message_${this.$page.props.auth.user.id}`)
            .listen('.send_message', res => {
                this.mess = res.message
            });
    },

    methods:{
        async sendLike(id){
            const data = {from_id: this.$page.props.auth.user.id};
            const response = await axios.post(`/users/${id}`, data);
        },


        async sendMessage(id){
            const from_user = this.$page.props.auth.user;
            const data = {from_id : from_user.id, from_email: from_user.email, message: this.my_message};
            const response = await axios.post(`/users/${id}/sendMessage`, data);
        }
    }
}
</script>

<style scoped>

</style>
