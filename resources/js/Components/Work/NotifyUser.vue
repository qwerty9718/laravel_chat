<template>
    <a href="#!" class="list-group-item list-group-item-action">
        <div class="row align-items-center">
            <div class="col-auto">
                <!-- Avatar -->
                <img alt="Image placeholder" src="https://demos.creative-tim.com/argon-dashboard/assets-old/img/theme/team-1.jpg" class="avatar rounded-circle">
            </div>
            <div class="col ml--2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0 text-sm">{{user.name}}</h4>
                    </div>
                    <div class="text-right text-muted">
                        <small>2 hrs ago</small>
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
