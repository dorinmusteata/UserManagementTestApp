import Vue from 'vue'
import Vuex from 'vuex'
import api from '@/utils/api';
import Cookies from 'js-cookie'

Vue.use(Vuex)

const DEFAULT_LIMIT = 15
const DEFAULT_PAGE = 1

export default new Vuex.Store({
  state: {
    users: [],
    userGroups: [],
    groups: [],
    group: {},
    permissions: [],
    token: Cookies.get('token'),
    user: {},
    error: ''
  },
  mutations: {
    SET_ERROR(state, data) {
      if (typeof data.data !== 'undefined') {
        const errors = data.data.error.errors
        let message = ''
        Object.keys(errors).map(element => {
          message += `${errors[element][0]} `
        });
        //
        state.error = ''
        state.error = `${data.data.error.message} -- ${message}`
      }
    },
    SAVE_TOKEN(state, data) {
      state.token = data
      Cookies.set('token', data, {
        expires: 365
      })
    },
    REMOVE_TOKEN(state, data) {
      state.token = ""
      state.user = void 0;
    },
    FETCH_USER_SUCCESS(state, data) {
      state.user = data
    },
    EDIT_USER(state, data) {
      const index = state.users.indexOf(data.user)
      if (index !== -1) {
        state.users[index].name = data.form.name
        state.users[index].email = data.form.email
      }
    },
    DELETE_USER(state, data) {
      const index = state.users.indexOf(data.user)
      if (index !== -1) {
        Vue.delete(state.users, index)
      }
    },
    SET_USERS(state, data) {
      if (data.page === 1 && Array.isArray(data.data)) {
        state.users = data.data
      } else {
        state.users.push(...data.data)
      }
    },
    SET_USER_GROUPS(state, data) {
      if (data.page === 1 && Array.isArray(data.data)) {
        state.userGroups = data.data
      } else {
        state.userGroups.push(...data.data)
      }
    },
    REMOVE_USER_GROUP(state, data) {
      const index = state.userGroups.indexOf(data)
      if (index !== -1) {
        Vue.delete(state.userGroups, index)
      }
    },
    SET_GROUP(state, data) {
      state.group = data
    },
    EDIT_GROUP(state, data) {
      const index = state.groups.indexOf(data.group)
      if (index !== -1) {
        state.groups[index].name = data.name
      }
      state.group = state.groups[index]
    },
    DELETE_GROUP(state, data) {
      const index = state.groups.indexOf(data.group)
      if (index !== -1) {
        Vue.delete(state.groups, index)
      }
      state.group = {}
    },
    SET_GROUPS(state, data) {
      state.groups.push(...data)
    },
    SET_PERMISSIONS(state, data) {
      if (data.page === 1 && Array.isArray(data.data)) {
        state.permissions = data.data
      } else {
        state.permissions.push(...data.data)
      }
    },
    REMOVE_PERMISSION(state, data) {
      state.permissions.splice(state.permissions.indexOf(data), 1);
    }
  },
  actions: {
    login: async ({
      commit,
      state
    }, payload) => {
      api.post(`login`, payload).then((data) => {
        commit('FETCH_USER_SUCCESS', data.data.user)
        commit('SAVE_TOKEN', data.data.token)
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    register: async ({
      commit,
      state
    }, payload) => {
      api.post(`register`, payload).then((data) => {
        commit('FETCH_USER_SUCCESS', data.data.user)
        commit('SAVE_TOKEN', data.data.token)
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    fetchUser: async ({
      commit,
      state
    }, payload) => {
      api.get(`user`, payload).then((data) => {
        commit('FETCH_USER_SUCCESS', data.data.user)
      }).catch((error) => {
        commit('SET_ERROR', error)
        commit('REMOVE_TOKEN', {})
      })
    },
    createUser: async ({
      commit,
      state
    }, payload) => {
      await api.post(`users`, payload).then((data) => {
        commit('SET_USERS', {
          data: [data.data.user],
          page: 2
        })
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    getUsers: async ({
      commit,
      state
    }, payload) => {
      const limit = (payload.limit) ? payload.limit : DEFAULT_LIMIT,
        page = (payload.page) ? payload.page : DEFAULT_PAGE;
      //
      await api.get(`users?limit=${limit}&page=${page}`).then((data) => {
        commit('SET_USERS', {
          data: data.data,
          page: page
        })
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    editUser: async ({
      commit,
      state
    }, payload) => {
      const form = payload.form
      await api.put(`users/${payload.user.id}?name=${form.name}&email=${form.email}`).then((data) => {
        commit('EDIT_USER', payload)
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    deleteUser: async ({
      commit,
      state
    }, payload) => {
      await api.delete(`users/${payload.user.id}`).then((data) => {
        commit('DELETE_USER', payload)
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    deleteUserGroup: async ({
      commit,
      state
    }, payload) => {
      //
      await api.delete(`users/${payload.user.id}/groups/${payload.group.id}`).then((data) => {
        commit('REMOVE_USER_GROUP', payload.group)
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    getUserGroups: async ({
      commit,
      state
    }, payload) => {
      const limit = (payload.limit) ? payload.limit : DEFAULT_LIMIT,
        page = (payload.page) ? payload.page : DEFAULT_PAGE;
      //
      await api.get(`users/${payload.user.id}/groups?limit=${limit}&page=${page}`).then((data) => {
        commit('SET_USER_GROUPS', {
          data: data.data,
          page: page
        })
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    addUserGroup: async ({
      commit,
      state
    }, payload) => {
      //
      await api.post(`users/${payload.user.id}/groups`, {
        group: payload.group.id
      }).then((data) => {
        const duplicate = state.userGroups.find((i) => i.name === data.data.name)
        if (duplicate) {
          return;
        }
        commit('SET_USER_GROUPS', {
          data: [data.data],
          page: 2
        })
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    searchGroups: async ({
      commit,
      state
    }, payload) => {
      return await api.get(`groups?query=${payload.query}&limit=${DEFAULT_LIMIT}&page=${DEFAULT_PAGE}`).then((data) => {
        return data.data
      })
    },
    getGroups: async ({
      commit,
      state
    }, payload) => {
      const limit = (payload.limit) ? payload.limit : DEFAULT_LIMIT,
        page = (payload.page) ? payload.page : DEFAULT_PAGE;
      //
      await api.get(`groups?limit=${limit}&page=${page}`).then((data) => {
        commit('SET_GROUPS', data.data)
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    createGroup: async ({
      commit,
      state
    }, payload) => {
      await api.post(`groups`, payload).then((data) => {
        commit('SET_GROUPS', [data.data])
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    editGroup: async ({
      commit,
      state
    }, payload) => {
      await api.put(`groups/${payload.group.id}?name=${payload.name}`).then((data) => {
        commit('EDIT_GROUP', payload)
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    deleteGroup: async ({
      commit,
      state
    }, payload) => {
      await api.delete(`groups/${payload.group.id}`).then((data) => {
        commit('DELETE_GROUP', payload)
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    getGroupPermissions: async ({
      commit,
      state
    }, payload) => {
      const limit = (payload.limit) ? payload.limit : DEFAULT_LIMIT,
        page = (payload.page) ? payload.page : DEFAULT_PAGE,
        group = payload.group;
      //
      commit('SET_GROUP', group)
      await api.get(`groups/${group.id}/permissions?limit=${limit}&page=${page}`).then((data) => {
        commit('SET_PERMISSIONS', {
          data: data.data,
          page: page
        })
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    addGroupPermission: async ({
      commit,
      state
    }, payload) => {
      //
      await api.post(`groups/${state.group.id}/permissions`, {
        name: payload.name
      }).then((data) => {
        commit('SET_PERMISSIONS', {
          data: data.data,
          page: 1
        })
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    },
    deleteGroupPermission: async ({
      commit,
      state
    }, payload) => {
      //
      await api.delete(`groups/${state.group.id}/permissions/${payload.permission.id}`).then((data) => {
        commit('REMOVE_PERMISSION', payload.permission)
      }).catch((error) => {
        commit('SET_ERROR', error)
      })
    }
  },
  getters: {
    token: (state) => {
      return state.token
    },
    users: (state) => {
      return state.users
    },
    groups: (state) => {
      return state.groups
    },
    permissions: (state) => {
      return state.permissions
    },
    user: (state) => {
      return state.user
    },
    userGroups: (state) => {
      return state.userGroups
    },
    error: (state) => {
      return state.error
    },
  }
})