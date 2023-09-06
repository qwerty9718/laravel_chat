<template>
    <div class="card-header shadow-xl">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <h3 class="mb-0 d-block" v-if="getSecondUser">{{getSecondUser.name}}</h3>
                        <span class="text-sm text-muted" v-if="getSecondUser"><span class="font-weight-bold">{{getSecondUser.email}}</span></span>
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
