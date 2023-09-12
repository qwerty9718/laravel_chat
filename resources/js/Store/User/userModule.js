import axios from "axios";
import {useForm} from "@inertiajs/vue3";

export const userModule = {
    state: () => ({
        url: 'http://95.130.227.47:82/',
        //  url: 'http://localhost:8000/',
        me: null,

    }),

    getters: {
        getAuthUser(state){
            return state.me
        },

        getUrl(state){
            return state.url
        },
    },
    mutations:{

    },
    actions: {
        setAuthUser({state, commit, dispatch},{user}){
            state.me = user
        },

        async updateUser({state, commit, dispatch},{user}){
            const data = {id: user.id,name: user.name,email: user.email,surname :user.surname,phone: user.phone,country: user.country,city: user.city};
            const response = await axios.patch(state.url+'chat/updateUser', data);
        },



    },
    namespaced: true
}
