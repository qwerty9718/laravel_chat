<template>
    <div class="card-header shadow-xl" v-if="getSecondUser.id !== 0">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center">
                    <div class="ms-3">

                        <div>
                            <h3 class="mb-0 d-block" >{{getSecondUser.name}}</h3>
                            <span class="text-sm text-muted" ><span class="font-weight-bold">{{getSecondUser.email}}</span></span>
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
