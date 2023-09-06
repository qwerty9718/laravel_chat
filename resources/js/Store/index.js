import { createApp } from 'vue';
import { createStore } from 'vuex';
import {messageModule} from "@/Store/Message/messageModule";
import {workModule} from "@/Store/Message/workModule";
import {notifyModule} from "@/Store/Message/notifyModule";

const store = createStore({
    modules:{
        // task: taskModule,
        message: messageModule,
        work: workModule,
        notifyModule: notifyModule
    }
})

export default store
