import axios from "axios";

export const workModule = {
    state: () => ({
        // url: 'http://95.130.227.47:82/',
        url: 'http://localhost:8000/',
        secondUser: {id:0},
        messages: {array: [], chat_room: null},
        body: '',
        chat_id : null,
        status_chat: null,
        page: 1,
        last_page: 1,
        loader: false,
    }),

    getters: {
        getSecondUser(state){
            return state.secondUser
        },
        getMessages(state) {
            return state.messages;
        },

        getBody(state) {
            return state.body;
        },

        getChat_id(state){
            return state.chat_id
        },
        getStatus_chat(state){
            return state.status_chat
        },

        getPage(state){
            return state.page
        },
        getLastPage(state){
            return state.last_page
        },
        getLoader(state){
            return state.loader
        },
        getTest(state){
            return state.test
        }


    },
    mutations: {
        setSecondUser(state, user){
            state.secondUser = user
        },

        setMessages(state, array) {
            array.reverse();
            state.messages.array = array;
        },
        setMessagesChatId(state, chat_id) {
            state.messages.chat_room = chat_id;
        },

        setBody(state, body) {
            state.body = body
        },

        setStatus_chat(state, status_chat){
            state.status_chat = status_chat
        },

        setChat_id(state, id){
          state.chat_id = id;
        },


        addMessages(state, array ) {
            if (state.messages.array.length <= 0){
                state.messages.array.push(array);
            }
            else {
                state.messages.array = [...state.messages.array.push(array)];
            }

        },

        setPage(state, page){
            state.page = page;
        },

        setLastPage(state, page){
            state.last_page = page;
        },
        setLoadMessages(state, array){
            array.reverse();
            state.messages.array.unshift(...array);
        },

    },
    actions: {

        // Все данные у чата
        async getChatRoom({state, commit, dispatch},{me,secondUser}){
            const response = await axios.post(state.url+'chat/getChat',{me:me.id, secondUser:secondUser.id});
            dispatch('notifyModule/changeNotifyStatus', {secondUser:secondUser}, {root:true});
            if(response.data.messages.data){
                commit('setMessages', response.data.messages.data);
                commit('setPage', response.data.messages.current_page);
                commit('setLastPage',response.data.messages.last_page);

            }
            else {
                commit('setMessages', response.data.messages);
                commit('setPage', 1);
                commit('setLastPage',1)
                commit('setChat_id',response.data.current_chat);
            }
            commit('setSecondUser',response.data.second_user);
            commit('setStatus_chat', response.data.status_chat);
            commit('setChat_id',response.data.current_chat.id);

            await dispatch('notifyModule/deleteNotify', {me:me,second_user:secondUser}, {root:true});

        },


        // Создание нового чата
        async createNewChat({state, commit, dispatch},{me,second_user}){
            const name = me.name + '_' + second_user.name;
            const data = {name: name, me:me.id, second_user: second_user.id};
            const response = await axios.post(state.url+'chat/createChatRoom',data);
            commit('setMessages', response.data.messages);
            commit('setChat_id', response.data.chat_room_id)
            commit('setStatus_chat',response.data.status_chat);
        },

        // Отправака Сообщений
        async sendMessage({state, commit, dispatch},{me_id,chat_room_id,second_user_id}){
            const data = {body: state.body, user_id: me_id, chat_room_id: chat_room_id,second_user_id:second_user_id};
            commit('setBody', '')
            const response = await axios.post(state.url + 'chat/sendMessage', data);
            dispatch('addMessageToArrayList',response.data);
        },

        // Добавляем сообщение (Для Pusher)
        addMessageToArrayList({state, commit}, message) {
            commit('addMessages', message);
        },

        // Загрузка доп сообщений
        async loadMore({state, commit, dispatch},{page,chat_id}){
            if (page < state.last_page){
                page++;
                commit('setPage', page);
                state.loader = true;
                const response = await axios.get(state.url+'chat/loadMoreMessages/'+chat_id+'?page='+state.page);
                commit('setLoadMessages',response.data.data);
                state.loader = false;
            }
        },

        startInfoNull({state, commit, dispatch}){
            state.secondUser = {id:0};
            state.messages = {array: [], chat_room: null};
            state.body = '';
            state.chat_id = null;
            state.status_chat = null;
            state.page = 1;
            state.last_page = 1;
            state.loader = false;
        },

        deleteChatAsync({state, commit, dispatch},{chat_id}){
            state.messages.array = [];
        },

    },
    namespaced: true
}
