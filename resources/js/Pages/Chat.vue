<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import store from '@/store.js';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden
                shadow-xl sm:rounded-lg flex"
                style="min-height: 400px; max-height: 400px;">
                    <!-- componente do chat -->
                    <!-- menu e form para enviar e receber mensagens -->

                    <!-- list users -->
                    <div class="w-3/12 bg-gray-500 bg-opacity-25
                    border-r border-gray-300
                    overflow-y-scroll">
                        <ul>

                            <li v-for="user in users"
                            :key="user.id"
                            @click="() => {loadMessages(user.id)}"
                            :class="(userActive != null && userActive == user.id) ? 'bg-indigo-200 bg-opacity-50' : ''"
                            class="p-6 text-lg text-gray-700 leading-7
                            font-semibold border-b border-gray-300
                            hover:bg-gray-100 hover:bg-opacity-50 hover:cursor-pointer">

                                <p class="flex items-center">
                                    {{ user.name }}
                                    <span class="ml-2 w-2 h-2
                                    bg-blue-500 rounded-full">
                                    </span>
                                </p>

                            </li>
                            
                        </ul>
                    </div>

                    <!-- box messages -->
                    <div class="w-9/12 flex flex-col justify-between">

                        <!--  messages -->
                            <div class="w-full p-6 flex flex-col overflow-y-scroll">

                                <div v-for="message in messages"
                                :key="message.id"
                                :class="(message.from == $page.props.auth.user.id) ? 'text-right' : 'text-left' "
                                class="w-full mb-3 scroll-message">
                                    <p
                                    :class="(message.from == $page.props.auth.user.id) ? 'messageFromMe' : 'messageToMe' "
                                    class="inline-block p-2 rounded-md"
                                    style="max-width: 75%;">
                                        {{message.content}}
                                    </p>
                                    <span class="block mt-1 text-xs text-gray-500">
                                           <!--  {{message.created_at}} --->
                                        {{$filters.formatDate(message.created_at)}}

                                    </span>
                                </div>

                            </div>



                            <!-- form -->
                            <div v-if="userActive"
                            class="w-full bg-blue-200 bg-opacity-25
                               p-6 border-t border-blue-200">
                              <form v-on:submit.prevent="sendMessage">
                                    <div class="flex rounded-md
                                    overflow-hidden border border-blue-200">
                                        <input v-model="message" type="text" class="flex-1 px-4 py-2 text-sm
                                        focus:outline-none">
                                        <button type="submit" class="bg-indigo-500
                                        hover:bg-indigo-600 text-white px-4 py-2">
                                            Enviar
                                        </button>
                                    </div>
                               </form>
                            </div>

                    </div>

                </div>

            </div>

        </div>
    </AppLayout>
</template>

<script>
    export default {
        data(){
            return {
                users: [],
                messages: [],
                userActive: null,
                message: ''
            }
        },

        computed: {
            user(){
                return store.state.user
            }
        },

        methods:{
            scrollToBottom: function(){
                if(this.messages.length){
                    document.querySelectorAll('.scroll-message:last-child')[0].scrollIntoView()
                }
            },
            loadMessages: async function(user) {
                    await axios.get(`api/messages/${user}`).then(response => {
                        this.messages = response.data.messages
                        this.userActive = user
                        //console.log(this.userActive);
                    });

                    this.scrollToBottom()
                },

            sendMessage: async function (){
                //recebe o valor da mensagem pelo v-model="message"
                await axios.post('api/messages/store', {
                    'content': this.message,
                    'to': this.userActive
                }).then(response => {

                    this.messages.push({
                        'from': this.user.id,
                        'to': this.userActive,
                        'content': this.message,
                        'created_at': new Date().toISOString(),
                        'updated_at': new Date().toISOString()
                    })

                    this.message=""
                    //console.log(response)
                })

                this.scrollToBottom()
                //console.log(this.message)
            }
        },

        mounted() {
            //essa funçao eh executada quando o componente eh montado
            //ver usuario logado
            //console.log(this.user)
            axios.get('api/users').then(response => {
                this.users = response.data.users
                //console.log(this.users);
            });

            //se conectar ao canal privado do usuario selecionado
            //o canal envia a notificaçao e ouve o evento
            Echo.private(`user.${this.user.id}`).listen('.SendMessage', (content) => {
                console.log(" message content ")
                console.log(content)
            } )
        }
    }
</script>

<style>
    .messageFromMe{
        @apply bg-indigo-300 bg-opacity-25;
    }

    .messageToMe{
        @apply bg-gray-300 bg-opacity-25;
    }
</style>