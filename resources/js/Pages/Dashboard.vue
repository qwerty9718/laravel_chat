<template>
    <Head title="Dashboard" />

    <div class="container rounded bg-white mt-5 mb-5" v-if="me">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuBJT5wHCiGz1_ahHSkMCToJutWRc7_GtpEklerkC0wtu0zj9j0mRsCuUVCWRx4gtCQkc&usqp=CAU" alt="">
                    <span class="font-weight-bold"></span><span class="text-black">{{me.name}}</span><span> </span>
                    <span class="font-weight-bold"></span><span class="text-black-50">{{me.email}}</span><span> </span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Name</label>
                            <input type="text" class="form-control text-black bold" placeholder="first name" v-model="me.name">
                        </div>
                        <div class="col-md-6"><label class="labels">Email</label>
                            <input type="email" class="form-control text-black bold" placeholder="email"  v-model="me.email">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mb-3"><label class="labels">Surname</label><input type="text" class="form-control" placeholder="enter surname" v-model="me.surname"></div>
                        <div class="col-md-12 mb-3"><label class="labels">Mobile Number</label><input type="number" class="form-control" placeholder="enter phone number" v-model="me.phone"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" v-model="me.country"></div>
                        <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control"  placeholder="state" v-model="me.city"></div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button" @click.prevent="updateUser({user:me})">Save Profile</button></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5 text-center">
                    <Link class="btn btn-primary font-semibold text-xl text-white leading-tight" :href="route('chat.index')">Chat</Link>
                    <Link class="btn btn-danger font-semibold text-xl text-white leading-tight" :href="route('logout')" method="post" as="button">Logout</Link>

                </div>
            </div>
        </div>
    </div>


</template>

<script>
import {mapMutations,mapState,mapGetters,mapActions} from "vuex";
import {Head, useForm} from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3'
export default {
    name: "Dashboard",
    components:{Head,Link},
    computed:{
        ...mapGetters({
            me: 'userModule/getAuthUser'
        })
    },

    methods:{
        ...mapActions({
            setAuthUser: 'userModule/setAuthUser',
            updateUser: 'userModule/updateUser'
        })
    },

    mounted() {
        this.setAuthUser({user: this.$page.props.auth.user});
    }

}
</script>

<style scoped>

</style>
