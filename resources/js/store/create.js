import { OK, CREATED, UNPROCESSABLE_ENTITY } from '../util'

const state = {
    notes: [],
    note: null,
    columns:[],
    apiStatus: null,
    noteErrorMessages: null,
    columnErrorMessages: null
}

const getters = {
    getnote: state => state.note
}

const mutations = {
    setNote (state, note) {
        state.notes = note
    },
    setApiStatus (state, status) {
        state.apiStatus = status
    },
    setnoteErrorMessages (state, messages) {
        state.noteErrorMessages = messages
    },
    setColumn (state, columns) {
        state.columns = columns
    },
    setcolumnErrorMessages (state, messages) {
        state.columnErrorMessages = messages
    }
}

const actions = {
    //ノート作成
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
    },
    async update (context, data) {
        context.commit('setApiStatus', null)
        const response = await axios.put('/api/notes/' + data.id, data)
            .catch(err => err.response || err)

        if (response.status === OK) {
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
        
    },
    async delete (context, data) {
        context.commit('setApiStatus', null)
        const response = await axios.delete('/api/notes/'+ data.id, data)
            .catch(err => err.response || err)

        if (response.status === OK) {
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
        
    },
    //コラム作成
    async column (context, data) {
        context.commit('setApiStatus', null)
        const response = await axios.post('/api/columns', data)
            .catch(err => err.response || err)

        if (response.status === CREATED) {
            context.commit('setApiStatus', true)
            context.commit('setColumn', response.data)
            return false
        }
        context.commit('setApiStatus', false)
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setcolumnErrorMessages', response.data.errors)
            } else {
            context.commit('error/setCode', response.status, { root: true })
        }       
    },
    async columnupdate (context, data) {
        context.commit('setApiStatus', null)
        const response = await axios.put('/api/columns/' + data.id, data)
            .catch(err => err.response || err)

        if (response.status === OK) {
            context.commit('setApiStatus', true)
            context.commit('setColumn', response.data)
            return false
        }
        context.commit('setApiStatus', false)
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setcolumnErrorMessages', response.data.errors)
          } else {
            context.commit('error/setCode', response.status, { root: true })
        }
        
    },
    async columndelete (context, data) {
        context.commit('setApiStatus', null)
        const response = await axios.delete('/api/columns/'+ data.id, data)
            .catch(err => err.response || err)

        if (response.status === OK) {
            context.commit('setApiStatus', true)
            context.commit('setColumn', response.data)
            return false
        }
        context.commit('setApiStatus', false)
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setcolumnErrorMessages', response.data.errors)
          } else {
            context.commit('error/setCode', response.status, { root: true })
        }
        
    },
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}