<template>
    <div class="card-header shadow-xl" v-show="getSecondUser.id !== 0">
        <div class="row">
            <div class="col-md-10 ">
                <div class="d-flex align-items-center">
                    <div class="ms-3">

                        <div class="container" style="display: flex; justify-content: space-between">
                            <div  v-show="getSecondUser.id !== 0">
                                <img alt="Image"
                                     v-show="getSecondUser.avatar_url"
                                     :src="getSecondUser.avatar_url"
                                     class="avatar shadow">
                                <img alt="Image"
                                     v-show="!getSecondUser.avatar_url"
                                     src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzH6TfTtq91hzmeIvm_4JOdb5y1UWjTlYZdA&usqp=CAU"
                                     class="avatar shadow">
                            </div>
                            <div class="ml-4">
                                <h3 class="mb-0 d-block text-truncate" style="max-width: 150px;">{{getSecondUser.name}}</h3>
                                <span class="text-sm text-muted"><span class="font-weight-bold d-inline-block text-truncate"  style="max-width: 150px;">{{getSecondUser.email}}</span></span>
                            </div>

                          <div class="container ml-3" v-show="getChat_id"><button class="btn btn-danger btn-sm" @click="deleteChat(getChat_id)">delete chat</button></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import {mapGetters,mapActions} from "vuex";
import axios from "axios";

export default {
    name: "SecondUserInfoBlock",
    props:{
        getSecondUser:{type: Object, required: true},
        getChat_id:{type: Object}
    },

    computed:{
      ...mapGetters({
        getUrl:'userModule/getUrl'
      })
    },

    methods:{

      ...mapActions({
        deleteChatAsync: 'work/deleteChatAsync'
      }),

      async deleteChat(id){
        const response = await axios.delete(this.getUrl+'chat/deleteChat/'+id);
        this.deleteChatAsync({chat_id:id});
      }
    },



}
</script>

<style scoped>

</style>
