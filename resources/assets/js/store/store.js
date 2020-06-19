import Vue from 'vue'
import Vuex from 'vuex'
import Echo from 'laravel-echo'

Vue.use(Vuex);

const title = document.title;
const updateTitle = function (conversations) {
    let unread = Object.values(conversations).reduce((acc, conversation) => conversation.unread + acc, 0);
    if (unread === 0) {
        document.title = title
    } else {
        document.title = `(${unread}) ${title}`
    }
};


const fetchApi = async function (url, options = {}) {
    let response = await fetch(url, {
        credentials: 'same-origin',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        ...options
    });

    if (response.ok) {
        return response.json()
    } else {
        throw await response.json()
    }

};

export default new Vuex.Store({
    strict: true,
    state: {
        user: null,
        me: {},
        conversations: {},
        openedConversations: [],
        takeUser: {}
    },
    getters: {
        user: function (state) {
            return state.user
        },
        takeUser: function (state) {

            return state.takeUser

        },
        me: function (state) {
            return function (id) {
                return state.me[id] || {}
            };

        },
        conversations: function (state) {
            return state.conversations
        },
        conversation: function (state) {
            return function (id) {
                return state.conversations[id] || {}
            }
        },
        messages: function (state) {
            return function (id) {
                let conversation = state.conversations[id];
                if (conversation && conversation.messages) {
                    return conversation.messages
                } else {
                    return []
                }

            }

        },
    },
    mutations: {
        readMessage: function (state, message) {
            let conversation = state.conversations[message.from_id];
            if (conversation && conversation.messages) {
                let msg = conversation.messages.find(m => m.id === message.id)
                if (msg) {
                    msg.read_at = (new Date()).toISOString()
                }

            }
        },
        incrementUnread: function (state, id) {
            let conversation = state.conversations[id];
            if (conversation) {
                conversation.unread++
            }
        },
        OpenedConversation: function (state, id) {
            state.openedConversations = [id]
        },
        setUser: function (state, userId) {
            state.user = userId
        },
        markAsRead: function (state, id) {
            state.conversations[id].unread = 0
        },
        setTakeUser: function (state, TakeUserId) {
            state.takeUser = TakeUserId
        },
        setme: function (state, me) {
            state.me = me
        },
        addConversations: function (state, {conversations}) {
            conversations.forEach(function (c) {
                let conversation = state.conversations[c.id] || {messages: [], count: 0};
                conversation = {...conversation, ...c};
                state.conversations = {...state.conversations, ...{[c.id]: conversation}}
            });

        },
        addMessages: function (state, {messages, id, count, takeUser, me}) {
            let conversation = state.conversations[id] || {};
            conversation.messages = messages;
            conversation.count = count;
            conversation.takeUser = takeUser;
            conversation.me = me;
            conversation.loaded = true;
            state.conversations = {...state.conversations, ...{[id]: conversation}}
        },
        prependMessages: function (state, {messages, id}) {
            let conversation = state.conversations[id] || {};
            conversation.messages = [...messages, ...conversation.messages];
            state.conversations = {...state.conversations, ...{[id]: conversation}}
        },
        addMessage: function (state, {message, id}) {
            state.conversations[id].count++;
            state.conversations[id].messages.push(message)

        }
    },
    actions: {
        loadConversations: async function (context) {
            let response = await fetchApi('/api/conversations');
            context.commit('addConversations', {conversations: response.conversations})
        },
        loadMessages: async function (context, conversationId) {

            context.commit('OpenedConversation', parseInt(conversationId, 10));

            if (!context.getters.conversation(conversationId).loaded) {
                let response = await fetchApi('/api/conversations/' + conversationId);
                context.commit('addMessages', {
                    messages: response.messages,
                    id: conversationId,
                    count: response.count,
                    takeUser: response.takeUser,
                    me: response.me
                })
                context.commit('setTakeUser', response.takeUser);
                context.commit('setme', response.me)

            }
            context.getters.messages(conversationId).forEach(message => {
                if (message.read_at === null && message.to_id === context.state.user) {
                    context.dispatch('markAsRead', message)
                }
            })
            context.commit('markAsRead', conversationId);
            updateTitle(context.state.conversations)
        },
        sendMessage: async function (context, {content, userId}) {
            let response = await fetchApi('/api/conversations/' + userId, {
                method: 'POST',
                body: JSON.stringify({
                    content: content
                })
            })
            context.commit('addMessage', {message: response.message, id: userId})
        },
        loadPreviousMessages: async function (context, conversationId) {
            let message = context.getters.messages(conversationId)[0]
            if (message) {
                let url = '/api/conversations/' + conversationId + '?before=' + message.created_at
                let response = await fetchApi(url)
                context.commit('prependMessages', {id: conversationId, messages: response.messages})
            }
        },
        setUser: function (context, userId) {
            context.commit('setUser', userId)
            new Echo({
                broadcaster: 'socket.io',
                host: window.location.hostname + ':6001'
            })
                .private(`App.User.${userId}`)
                .listen('NewMessages', function (e) {
                    context.commit('addMessage', {message: e.messages, id: e.messages.from_id});
                    if (!context.state.openedConversations.includes(e.messages.from_id) || document.hidden) {
                        context.commit('incrementUnread', e.messages.from_id);
                        updateTitle(context.state.conversations)
                    } else {
                        context.dispatch('markAsRead', e.messages)
                    }

                })
        },
        markAsRead: function (context, message) {
            fetchApi('/api/messages/' + message.id, {method: 'POST'});
            context.commit('readMessage', message)
        }

    }
})