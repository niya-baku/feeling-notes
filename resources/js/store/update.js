import { OK, CREATED, UNPROCESSABLE_ENTITY } from '../util'

const state = {
    note: null,
    apiStatus: null,
    noteErrorMessages: null
}

const getters = {}

const mutations = {
    setNote (state, note) {
        state.note = note
    },
    setApiStatus (state, status) {
        state.apiStatus = status
    },
    setnoteErrorMessages (state, messages) {
        state.noteErrorMessages = messages
    }
}

const actions = {
    async note (context, data) {
        context.commit('setApiStatus', null)
        const response = await axios.post('/api/notes', data)
            .catch(err => err.response || err)

        if (response.status === CREATED) {
            context.commit('setApiStatus', true)
            context.commit('setNote', response.data)
            return false
        }
        context.commit('setApiStatus', false)
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setnoteErrorMessages', response.data.errors)
          } else {
            context.commit('error/setCode', response.status, { root: true })
        }
        
    }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}