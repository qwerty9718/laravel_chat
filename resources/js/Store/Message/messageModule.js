import axios from "axios";

export const messageModule = {
    state: () => ({
        url:'http://localhost:8000/',
        messages: [],
        users: [],
        currentChat: null,
        body : ''
    }),

    getters: {
        getMessages(state){
            return state.messages;
        },

        getUsers(state){
            return state.users;
        },

        getCurrentChat(state){
            return state.currentChat;
        },

        getBody(state){
            return state.body
        },

    },
    mutations: {

        setMessages(state, messages){
            state.messages = messages
        },

        setUsers(state, users){
            state.users = users;
        },

        setCurrentChat(state,currentChat){
            state.currentChat = currentChat;
        },

        setBody(state, body){
            state.body = body
        },

        addMessages(state , message){
            state.messages = [...state.messages.push(message)]
        }
    },
    actions: {
        async getChatRoom({state, commit},id){
            commit('setCurrentChat',id);
            const response = await axios.get(`${state.url}chat-test/room/${id}`);
            commit('setMessages',response.data.messages);
            commit('setUsers',response.data.users)
        },


        async sendMessage({state, commit},{me_id, chat_room_id}){
            const data = {body: state.body, user_id: me_id, chat_room_id: chat_room_id};
            commit('setBody','')
            const response = await axios.post(state.url+'chat-test/sendMessage',data);
        },

        addMessageToArrayList({state, commit},message){
            commit('addMessages', message)
        }

    },
    namespaced: true
}
