<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3'
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"></h2>
            <Link class="btn btn-primary font-semibold text-xl text-white leading-tight" :href="route('chat.index')">Chat</Link>
        </template>
    </AuthenticatedLayout>
</template>
