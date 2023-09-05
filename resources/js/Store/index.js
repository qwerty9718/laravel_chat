import { createApp } from 'vue';
import { createStore } from 'vuex';
import {messageModule} from "@/Store/Message/messageModule";
import {workModule} from "@/Store/Message/workModule";

const store = createStore({
    modules:{
        // task: taskModule,
        message: messageModule,
        work: workModule
    }
})

export default store
