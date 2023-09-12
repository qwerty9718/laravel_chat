<template>
    <Head title="Dashboard" />


    <div class="container rounded bg-white mt-5 mb-5" v-if="me">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                    <div>
                        <img class="avatar_image" :src="me.avatar_url" alt="">
                        <img v-if="!me.avatar_url" class="avatar_image" src="https://static.vecteezy.com/system/resources/thumbnails/010/287/641/small/add-user-icon-isolated-on-a-white-background-add-friendship-symbol-for-web-and-mobile-apps-free-vector.jpg" alt="" @click="test">
                    </div>

                    <span class="font-weight-bold"></span><span class="text-black">{{me.name}}</span><span> </span>
                    <span class="font-weight-bold"></span><span class="text-black-50">{{me.email}}</span><span> </span>


                    <div class="container mt-2">
                        <input class="form-control mb-2" type="number" v-model="form.user_id" hidden/>
                        <input class="form-control mb-2" type="file" @input="form.avatar = $event.target.files[0]" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                            {{ form.progress.percentage }}%
                        </progress>
                        <button @click.prevent="submit" class="btn btn-primary">set image</button>
                    </div>

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
                    <Link class="btn btn-primary font-semibold text-xl text-white leading-tight mb-2" :href="route('chat.index')">Chat</Link>
                    <Link class="btn btn-danger font-semibold text-xl text-white leading-tight mb-2" :href="route('logout')" method="post" as="button">Logout</Link>

                    <button class="btn btn-danger font-semibold text-xl text-white leading-tight mt-2" @click="deleteAccount(me.id)">Delete account</button>


                </div>
            </div>
        </div>
    </div>


</template>

<script>
import {mapMutations,mapState,mapGetters,mapActions} from "vuex";
import {Head, useForm} from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import {Link} from '@inertiajs/vue3';
import axios from "axios";

export default {
    name: "Dashboard",
    components:{Head,Link},
    data(){
      return{
          form: useForm({
              user_id: null,
              avatar: null,
          }),
      }
    },
    computed:{
        ...mapGetters({
            me: 'userModule/getAuthUser',
            getUrl: 'userModule/getUrl'
        })
    },

    methods:{
        ...mapActions({
            setAuthUser: 'userModule/setAuthUser',
            updateUser: 'userModule/updateUser'
        }),


        async submit() {
            if (this.form.avatar !== null){
                const data = new FormData();
                data.append('user_id',this.form.user_id);
                data.append('avatar',this.form.avatar);
                const response = await axios.post(this.getUrl+'chat/uploadImg',data);
                this.me.avatar_url = response.data;
            }
            else {
                alert('choose the image');
            }
        },


        async deleteAccount(id){
            const response = await axios.delete(this.getUrl+'chat/deleteAccount/'+id);
            router.get(this.getUrl)
        },

    },

    mounted() {
        this.setAuthUser({user: this.$page.props.auth.user});
        this.form.user_id = this.me.id;
    }

}
</script>

<style scoped>
.avatar_image{
width: 225px;
    border-radius: 20px;
}
</style>
