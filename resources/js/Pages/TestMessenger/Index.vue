<template>
    <div class="w-1/2 mx-auto py-6">

        <div class="mb-4">
            <input v-model="body" type="text" class="rounded-full border border-gray-400" placeholder="your message">
        </div>

        <div class="mb-4">
            <button @click="store" class="rounded-lg block w-48 bg-sky-400 text-white text-center py-2">Send</button>
        </div>

        <div v-if="messages.length > 0">
            <div>Messages</div>

            <div class="text-sm" v-for="message in messages" :key="message.id">
                <h3 class="mb-2 mt-3">Id: {{ message.id }}</h3>
                <p class="mb-2">{{ message.body }}</p>
                <h4 class="text-right mb-4">{{ message.time }}</h4>
                <hr>
            </div>

        </div>


    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Index",
    data() {
        return {
            body: ''
        }
    },
    props: {
        messages: {type: Array}
    },


    methods: {
        async store() {
            const response = await axios.post('/messages', {body: this.body});
            this.messages.unshift(response.data);
            this.body = '';
        }
    },

    mounted() {
        window.Echo.channel('store_message')
            .listen('.store_message', res => {
                this.messages.unshift(res.message);
            });
    }
}
</script>

<style scoped>

</style>
