<template>
    <a href="#!" class="list-group-item list-group-item-action">
        <div class="row align-items-center">
            <div class="col-auto">
                <!-- Avatar -->
                <img v-if="!user.avatar_url" alt="Image placeholder" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzH6TfTtq91hzmeIvm_4JOdb5y1UWjTlYZdA&usqp=CAU" class="avatar rounded-circle">
                <img v-if="user.avatar_url" alt="Image placeholder" :src="user.avatar_url" class="avatar rounded-circle">

            </div>
            <div class="col ml--2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0 text-sm">{{user.name}}</h4>
                    </div>
                    <div class="text-right text-muted">
                        <small>message</small>
                    </div>
                </div>
            </div>
        </div>
    </a>
</template>

<script>
export default {
    name: "NotifyUser",
    props:{
        user:{type:Object}
    }
}
</script>

<style scoped>

</style>
