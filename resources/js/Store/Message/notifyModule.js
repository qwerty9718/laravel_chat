import axios from "axios";

export const notifyModule = {
    state: () => ({
        // url: 'http://95.130.227.47:82/',
        url: 'http://localhost:8000/',
        users: null,
        notifications: null,
        notificationPusher: {to_id:null, from_id:null}
    }),

    getters: {
        getUsers(state) {
            return state.users;
        },

        getNotifications(state){
            return state.notifications
        },

        getNotificationPusher(state){
            return state.notificationPusher
        }

    },
    mutations: {
        setNotifications(state,array){
            state.notifications = array;
        },

        setUsers(state, users) {
            state.users = users;
            for (let i = 0; i < state.notifications.length; i++) {
                for (let j = 0; j < state.users.length; j++) {
                    if (state.notifications[i].from_id == state.users[j].id){
                        state.users[j].notificate = true;
                    }
                    else {state.users[j].notificate = false;}
                }
            }
        },

        setNotificationPusher(state, value){
            state.notificationPusher = value;
        }

    },
    actions: {
        // async getChatRoom({state, commit, dispatch},{me,secondUser}){
        //     const response = await axios.post(state.url+'chat/getChat',{me:me, secondUser:secondUser});
        //     commit('setMessages', response.data.messages);
        //     commit('setSecondUser',response.data.second_user);
        //     commit('setStatus_chat', response.data.status_chat);
        //     commit('setChat_id',response.data.current_chat.id);
        //
        //     // dispatch('postList/minusPage', {}, {root:true})
        // },

        changeNotifyStatus({state, commit, dispatch},{secondUser}){
            secondUser.notificate = false;
        },
        deleteNotifyStatus({state, commit, dispatch},{me,secondUser}){

        }
    },
    namespaced: true
}
