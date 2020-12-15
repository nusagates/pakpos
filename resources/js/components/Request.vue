<template>
    <div class="container">
        <div class="form-group">
            <b-input-group>
                <template #prepend>
                    <b-form-select v-model="Request.Method" :options="Master.Method"></b-form-select>
                </template>
                <b-form-input v-model="Request.Url"></b-form-input>
                <template #append>
                    <b-button :disabled="Processing" @click="send_request" variant="outline-success">
                        <span v-if="Processing">Wait</span>
                        <span v-else>Send</span>
                    </b-button>
                </template>
            </b-input-group>
        </div>
        <div>
            <b-tabs content-class="mt-3">
                <b-tab title="Body" active>
                    <b-input-group v-for="(item, index) of Request.Body" :key="index">
                        <b-form-input @click="add_body(index)" placeholder="key" v-model="item.key"></b-form-input>
                        <b-form-input placeholder="value" v-model="item.value"></b-form-input>
                        <template #append>
                            <b-button @click="remove_body(index)" variant="outline-danger">x</b-button>
                        </template>
                    </b-input-group>
                </b-tab>
                <b-tab title="Header">
                    <p>
                        <b-input-group v-for="(item, index) of Request.Header" :key="index">
                            <b-form-input @click="add_header(index)" placeholder="key"
                                          v-model="item.key"></b-form-input>
                            <b-form-input placeholder="value" v-model="item.value"></b-form-input>
                            <template #append>
                                <b-button @click="remove_header(index)" variant="outline-danger">x</b-button>
                            </template>
                        </b-input-group>
                    </p>
                </b-tab>
            </b-tabs>
        </div>
        <hr/>
        <div class="form-group">
            <b-card
                header="Response"
                header-tag="header"
            >
                <b-card-text>
                    <prism >{{Response}}</prism>
                </b-card-text>
            </b-card>
        </div>
    </div>
</template>

<script>
import {component as VueCodeHighlight} from 'vue-code-highlight';
import 'prismjs'
import 'prismjs/themes/prism.css'
import Prism from 'vue-prism-component'
export default {
    components: {
        VueCodeHighlight,
        Prism
    },
    data() {
        return {
            Master: {
                Method: [
                    {value: 'get', text: 'GET'},
                    {value: 'post', text: 'POST'},
                ]
            },
            Request: {
                Method: 'get',
                Url: 'https://bengkelbaik.com/api/v1/workshop/login',
                Body: [
                    {key: 'username', value: '082225005825'},
                    {key: 'password', value: '12345678'}
                ],
                Header: [
                    {key: 'accept', value: 'application/json'},
                    {key: '', value: ''},
                ]
            },
            Response: '',
            Processing: false
        }
    },
    methods: {
        add_body(index) {
            let body_count = this.Request.Body.length
            if (body_count === index + 1) {
                this.Request.Body.push({key: '', value: ''})
            }

        },
        add_header(index) {
            let header_count = this.Request.Header.length
            if (header_count === index + 1) {
                this.Request.Header.push({key: '', value: ''})
            }

        },
        remove_body(index) {
            if (this.Request.Body.length > 1) {
                this.Request.Body.splice(index, 1);
            }
        },
        remove_header(index) {
            if (this.Request.Header.length > 1) {
                this.Request.Header.splice(index, 1);
            }
        },
        send_request() {
            this.Processing = true
            axios.post('/request', this.Request).then(res => {
                this.Response = res.data
                this.Processing = false
            })
                .catch(err => {
                    this.Processing = false
                    this.Response = "Error"
                })
        }
    }
}
</script>

<style scoped>

</style>
