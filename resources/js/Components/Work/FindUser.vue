<template>
    <form class="navbar-search navbar-search-dark form-inline mr-sm-3 mb-0" id="navbar-search-main">
        <div class="form-group mb-0">
            <div class="input-group input-group input-group-merge">
                <input class="form-control ml-2" placeholder="Type here..." type="text" v-model="getQuery" @update:model-value="setQuery">
                <div class="input-group-append mr-2">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
            </div>
        </div>
        <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
        </button>
    </form>
</template>

<script>
import {mapMutations, mapGetters} from "vuex";

export default {
    name: "FindUser",

    computed:{
        ...mapGetters({
            getQuery: 'notifyModule/getQuery',
        }),

    },

    methods:{
        ...mapMutations({
            setQuery: 'notifyModule/setQuery',
        })
    }
}
</script>

<style scoped>

</style>
