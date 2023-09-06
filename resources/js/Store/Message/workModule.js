import axios from "axios";

export const workModule = {
    state: () => ({
        // url: 'http://95.130.227.47:82/',
        url: 'http://localhost:8000/',
        secondUser: {id:0},
        messages: null,
        body: '',
        chat_id : null,
        status_chat: null,
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


    },
    mutations: {
        setSecondUser(state, user){
            state.secondUser = user
        },

        setMessages(state, messages) {
            state.messages = messages;
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

        addMessages(state, message) {
            if (state.messages.length <= 0){
                state.messages.push(message)
            }
            else {
                state.messages = [...state.messages.push(message)]
            }

        },
    },
    actions: {

        // Все данные у чата
        async getChatRoom({state, commit, dispatch},{me,secondUser}){
            const response = await axios.post(state.url+'chat/getChat',{me:me.id, secondUser:secondUser.id});
            dispatch('notifyModule/changeNotifyStatus', {secondUser:secondUser}, {root:true})
            commit('setMessages', response.data.messages);
            commit('setSecondUser',response.data.second_user);
            commit('setStatus_chat', response.data.status_chat);
            commit('setChat_id',response.data.current_chat.id);

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

    },
    namespaced: true
}
