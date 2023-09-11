<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div class="container-fluid">


        <div class="container-fluid text-center parent">
            <div class="container block" v-if="canLogin" >

                <Link  v-if="$page.props.auth.user" class="btn btn-primary font-semibold text-xl text-white leading-tight mb-2" :href="route('dashboard')">dashboard</Link>
                <Link  v-if="!$page.props.auth.user" class="btn btn-primary font-semibold text-xl text-white leading-tight mb-2" :href="route('login')">Log in</Link>
                <Link  v-if="!$page.props.auth.user" class="btn btn-primary font-semibold text-xl text-white leading-tight mb-2" :href="route('register')">Register</Link>


            </div>


        </div>
    </div>
</template>

<style>
    .parent {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        overflow: auto;
    }

    .block {
        width: 250px;
        height: 250px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -125px 0 0 -125px;
    }

</style>
