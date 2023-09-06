<template>
    <div class="main-content" id="panel">
        <div class="container-fluid pt-3">
            <div class="row removable">
                <div class="col-lg-12 px-sm-0">
                    <div class="card shadow-none px-0 bg-transparent mt-0 mb-4">
                        <div class="card-body px-0 pb-0">
                            <div class="px-0 pb-4">
                                <div class="container-fluid">
                                    <Link :href="route('dashboard')">dashboard</Link>
                                    <div class="row flex-row">
                                        <div class="col-lg-4 mb-4">
                                            <div class="card h-100 overflow-auto overflow-x-hidden mb-5 mb-lg-0 content-message">

                                                <!--  Контакты  -->
                                                <div class="card-body p-2" v-if="users">
                                                    <div v-for="user in users" :key="user.id" class="mb-2">
                                                        <div v-if="user.id !== me.id">
                                                            <a  href="#" :class="user.id === getSecondUser.id ? 'd-block p-2 rounded-lg bg-gradient-primary' : 'd-block p-2 rounded-lg'" @click.prevent="getChatRoom({me:me.id,secondUser:user.id})">
                                                                <div class="d-flex p-2">
                                                                    <img alt="Image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzH6TfTtq91hzmeIvm_4JOdb5y1UWjTlYZdA&usqp=CAU" class="avatar shadow">
                                                                    <div class="ml-2">
                                                                        <div class="justify-content-between align-items-center">
                                                                            <h4 :class="user.id === getSecondUser.id ?'mb-0 mt-1 text-white' : 'mb-0 mt-1'">{{user.name}}<span v-if="false" class="badge badge-danger ml-5">12313</span>
                                                                            </h4>
                                                                            <p :class="user.id === getSecondUser.id ? 'text-white mb-0 text-xs font-weight-normal' : 'text-black-50 mb-0 text-xs font-weight-normal'">{{user.email}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>


                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="card" style="height: 70vh;">
                                                <div class="card-header shadow-xl">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="d-flex align-items-center">
                                                                <!--  С кем переписка-->
                                                                <div class="ms-3">
                                                                    <h3 class="mb-0 d-block" v-if="getSecondUser">{{getSecondUser.name}}</h3>
                                                                    <span class="text-sm text-muted" v-if="getSecondUser"><span class="font-weight-bold">{{getSecondUser.email}}</span></span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="card-body overflow-auto overflow-x-hidden">

                                                    <div :class="message.user_id === me.id ? 'row justify-content-end text-right mb-1'  : 'row justify-content-start mb-1'" v-if="users" v-for="message in getMessages" :key="message.id">
                                                        <div class="col-auto">
                                                            <div :class="message.user_id === me.id ? 'card bg-gradient-primary text-white' : 'card'">
                                                                <div class="card-body p-2">
                                                                    <p>
                                                                        {{ message.body }}
                                                                    </p>
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


                                                <div class="card-footer d-block">
                                                    <form class="align-items-center">
                                                        <div class="input-group mb-3" v-show="getChat_id">
                                                            <input v-model="body" @update:model-value="setBody" type="text" placeholder="Send" class="form-control" aria-label="Amount (to the nearest dollar)">
                                                            <div class="input-group-append">
                                                                <a href="#" class="input-group-text" @click.prevent="sendMessage({user_id:me.id,chat_room_id:getChat_id})">
                                                                    <i class="fa fa-paper-plane"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>


export default {
    name: "WorkLayout",
}
</script>

<style scoped>

</style>
