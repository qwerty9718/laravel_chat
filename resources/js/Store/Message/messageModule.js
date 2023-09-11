import axios from "axios";

export const messageModule = {
    state: () => ({
        // url: 'http://95.130.227.47:82/',
        url: 'http://localhost:8000/',
        messages: [],
        users: [],
        currentChat: null,
        body: '',
    }),

    getters: {
        getMessages(state) {
            return state.messages;
        },

        getUsers(state) {
            return state.users;
        },

        getCurrentChat(state) {
            return state.currentChat;
        },

        getBody(state) {
            return state.body;
        },


    },
    mutations: {

        setMessages(state, messages) {
            state.messages = messages
        },

        setUsers(state, users) {
            state.users = users;
        },

        setCurrentChat(state, currentChat) {
            state.currentChat = currentChat;
        },

        setBody(state, body) {
            state.body = body
        },

        addMessages(state, message) {
            state.messages = [...state.messages.push(message)]
        },

    },
    actions: {
        async getChatRoom({state, commit, dispatch}, id) {
            commit('setCurrentChat', id);
            const response = await axios.get(`${state.url}chat-test/room/${id}`);
            commit('setMessages', response.data.messages);
            commit('setUsers', response.data.users);
            // await this.checkStatusChatRoom({},{chat_room_id:state.currentChat, messages:state.messages})
            await dispatch('checkStatusChatRoom',{chat_room_id:state.currentChat, messages:state.messages})
        },


        async sendMessage({state, commit}, {me_id, chat_room_id}) {
            const data = {body: state.body, user_id: me_id, chat_room_id: chat_room_id};
            commit('setBody', '')
            const response = await axios.post(state.url + 'chat-test/sendMessage', data);
        },

        addMessageToArrayList({state, commit}, message) {
            commit('addMessages', message)
        },

        async checkStatusChatRoom({state, commit}, {chat_room_id, messages}) {

            for (var i = messages.length - 1; i >= 0; i--) {

                if (messages[i].status == 0){
                    const response = await axios.patch(state.url + 'chat-test/chat-room/' + chat_room_id, {status: 0})
                    break;
                }

                if (messages[i].status == 1){
                    const response = await axios.patch(state.url + 'chat-test/chat-room/' + chat_room_id, {status: 1})
                    break;
                }
            }
        }

    },
    namespaced: true
}
