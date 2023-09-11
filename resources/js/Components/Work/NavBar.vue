<template>

    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom" id="navbarTop">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!--  Поиск  -->
                <form class="navbar-search navbar-search-dark form-inline mr-sm-3 mb-0" id="navbar-search-main">
                    <div class="form-group mb-0">
                        <div class="input-group input-group input-group-merge">
                            <input class="form-control ml-2" placeholder="Type here..." type="text">
                            <div class="input-group-append mr-2">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                        <span aria-hidden="true" class="text-white">×</span>
                    </button>
                </form>


                <!--  Уведомления -->
                <ul class="navbar-nav align-items-center  ml-md-auto ">
                    <!--  Открытие меню -->
                    <li class="nav-item d-sm-none">
                        <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                            <i class="ni ni-zoom-split-in"></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <!--  Логотип звонка -->
                        <a class="nav-link position-relative" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="badge badge-danger badge-sm position-absolute top-0 mt-n2 right-1 px-2 py-1" v-if="getNotifications.length > 0">{{getNotifications.length}}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xl py-0 overflow-hidden">
                            <div class="px-3 pt-3" v-if="getNotifications.length > 0">
                                <h6 class="text-sm text-muted m-0">You have <span class="text-primary">{{getNotifications.length}}</span> new notifications!</h6>
                            </div>
                            <div class="list-group list-group-flush" v-for="user in users" :key="user.id">
                                <div v-for="notify in getNotifications" :key="notify.id">
                                    <div v-if="notify.from_id === user.id"> <NotifyUser :user="user"/></div>
                                </div>

                            </div>
                        </div>
                    </li>
                </ul>


                <!--  Мой Аккаунт -->
                <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm" v-show="me.avatar_url" >
                                        <img alt="Image placeholder" :src="me.avatar_url" class="avatar_img">
                                </span>
                                <span class="avatar avatar-sm"  v-show="!me.avatar_url">
                                        <img alt="Image placeholder" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzH6TfTtq91hzmeIvm_4JOdb5y1UWjTlYZdA&usqp=CAU">
                                </span>
                            </div>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right ">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>

                            <Link :href="route('dashboard')" class="dropdown-item">
                                <i class="fa fa-user"></i>
                                <span>My profile</span>
                            </Link>

                            <div class="dropdown-divider"></div>
                            <Link :href="route('logout')" method="post" class="dropdown-item">
                                <i class="fa fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </Link>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import {mapMutations,mapState,mapGetters,mapActions} from "vuex";
import NotifyUser from "@/Components/Work/NotifyUser.vue";
import {Link} from '@inertiajs/vue3';

export default {
    name: "NavBar",
    components: {NotifyUser,Link},
    props: {
        users: {type: Array, required: true},
        me:{type:Object}
    },
    computed:{
        ...mapGetters({
            getNotifications: 'notifyModule/getNotifications',
            getNotifyUsers: 'notifyModule/getNotifyUsers'
        })
    },

    methods:{
        ...mapActions({
            showNotifyUsers:'notifyModule/showNotifyUsers'
        })
    },


    mounted() {
        this.showNotifyUsers({users:this.users});
    }


}
</script>

<style scoped>
.avatar-sm {
    font-size: 0.875rem;
    width: 50px;
    height: 40px;
}
.avatar_img{
    width: 100%;
    height: 100%;
}
</style>
