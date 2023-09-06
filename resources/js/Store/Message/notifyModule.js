import axios from "axios";

export const notifyModule = {
    state: () => ({
        // url: 'http://95.130.227.47:82/',
        url: 'http://localhost:8000/',
        users: null,
        notifications: null,
    }),

    getters: {
        getUsers(state) {
            return state.users;
        },

        getNotifications(state){
            return state.notifications
        },

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
                }
            }
        },
    },
    actions: {

        changeNotifyStatus({state, commit, dispatch},{secondUser}){
            secondUser.notificate = false;
        },

        setNotificationPusher({state, commit, dispatch},{res}){
            for (let i = 0; i < state.users.length; i++) {
                if (state.users[i].id == res.from_id){
                    state.users[i].notificate = true
                }
            }
        },

        async deleteNotify({state, commit, dispatch},{me,second_user}){
            const data = {me_id: me.id ,second_user_id: second_user.id};
            const response = await axios.post(state.url+'chat/delNotify',data)
        }

    },
    namespaced: true
}
