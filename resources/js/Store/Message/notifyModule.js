import axios from "axios";

export const notifyModule = {
    state: () => ({
        // url: 'http://95.130.227.47:82/',
        url: 'http://localhost:8000/',
        users: null,
        notifications: [],
        notifyUsers: [],
        findUser: [],
        query: '',
    }),

    getters: {
        getUsers(state) {
            return state.users;
        },

        getNotifications(state){
            return state.notifications;
        },

        getNotifyUsers(state){
            return state.notifyUsers;
        },
        getQuery(state){
            return state.query;
        },

        sortedAndSearchUsers(state){
            if (state.query !== ''){
                return state.users.filter(user => user.name.toLowerCase().includes(state.query.toLowerCase()))
            }
            if (state.query === ''){
                return state.users;
            }
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

        setQuery(state,query){
           state.query = query;
        },
    },
    actions: {

        changeNotifyStatus({state, commit, dispatch},{secondUser}){
            secondUser.notificate = false;
            state.notifications = state.notifications.filter(item => item.from_id !== secondUser.id);

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
        },

        // Добавление уведомлений в массив
        addNotifyToArray({state, commit, dispatch},{notify}){
            let bool = true;
            //Если массив Пуст
            if (state.notifications.length < 0){
                bool = true;
            }

            //Если массив полон
            if (state.notifications.length > 0){
                for (let i = 0; i < state.notifications.length; i++) {
                    if (state.notifications[i].from_id === notify.from_id && state.notifications[i].user_id === notify.user_id){
                        bool = false;
                        break;
                    }
                }
            }
            if (bool === true){state.notifications.push(notify);}
        },


        showNotifyUsers({state, commit, dispatch},{users}){

            for (let i = 0; i < state.notifications.length; i++) {
                let fromId = state.notifications[i].from_id;
                let user = users.find(user => user.id === fromId);
                if (user) {
                    state.notifyUsers = user;
                }
            }
        }

    },
    namespaced: true
}
