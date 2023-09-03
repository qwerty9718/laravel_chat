import { createApp } from 'vue';
import { createStore } from 'vuex';
import {messageModule} from "@/Store/Message/messageModule";

const store = createStore({
    modules:{
        // task: taskModule,
        message: messageModule
    }
})

export default store
