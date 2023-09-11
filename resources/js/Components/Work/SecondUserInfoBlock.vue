<template>
    <div class="card-header shadow-xl" v-if="getSecondUser.id !== 0">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center">
                    <div class="ms-3">

                        <div class="container" style="display: flex; justify-content: space-between">
                            <div>
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
                                <h3 class="mb-0 d-block" >{{getSecondUser.name}}</h3>
                                <span class="text-sm text-muted" ><span class="font-weight-bold">{{getSecondUser.email}}</span></span>
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
    name: "SecondUserInfoBlock",
    props:{
        getSecondUser:{type: Object, required: true}
    },
}
</script>

<style scoped>

</style>
