import axios from 'axios'
import utility from '@/utils/utility'
import Cookies from 'js-cookie'

// set token
var token = Cookies.get('token')

// create instance
const api = axios.create({
    baseURL: utility.apiHost,
    headers: {
        'Authorization': `Bearer ${token}`
    }
})

// export variables , methods
export default {
    async get(url, request) {
        return api.get(url, request)
            .then((response) => Promise.resolve(response.data))
            .catch((error) => Promise.reject(error.response.data))
    },
    async post(url, request) {
        return api.post(url, request)
            .then((response) => Promise.resolve(response.data))
            .catch((error) => Promise.reject(error.response.data))
    },
    async put(url, request) {
        return api.put(url, request)
            .then((response) => Promise.resolve(response.data))
            .catch((error) => Promise.reject(error.response.data))
    },
    async patch(url, request) {
        return api.patch(url, request)
            .then((response) => Promise.resolve(response.data))
            .catch((error) => Promise.reject(error.response.data))
    },
    async delete(url, request) {
        return api.delete(url, request)
            .then((response) => Promise.resolve(response.data))
            .catch((error) => Promise.reject(error.response.data))
    }
}