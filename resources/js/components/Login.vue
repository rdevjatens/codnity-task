<template>
    <div class="login-container">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" v-model="username">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" v-model="password">
        <button id="submit" @click="login()">Submit</button>
        <span v-if="this.loginError" id="login-error">Incorrect credentials</span>
        <News v-if="this.loggedIn"/>
    </div>
</template>

<script>
import axios from 'axios'
import News from './News.vue'
export default {
    data: function() {
        return {
                loggedIn: false,
                loginError: false
            }
        },
    methods: {
        login() {
            axios.post('api/login/login', {
                username: this.username,
                password: this.password
            })
            .then( response => {
                this.loginError = true
                if (response.data == 1) {
                    this.loggedIn = true
                    this.loginError = false
                }
                console.log(response)
            })
            .catch( error => {
                this.loginError = true
                console.log(error)
            })
        }
    },
        components: {
            News
    }
}
</script>