import { createApp } from 'vue';
import { createStore } from 'vuex';
import {messageModule} from "@/Store/Message/messageModule";
import {workModule} from "@/Store/Message/workModule";
import {notifyModule} from "@/Store/Message/notifyModule";
import {userModule} from "@/Store/User/userModule";

const store = createStore({
    modules:{
        // task: taskModule,
        message: messageModule,
        work: workModule,
        notifyModule: notifyModule,
        userModule: userModule
    }
})

export default store
