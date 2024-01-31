import Vue from 'vue'
import Vuex from 'vuex'

//Vue.use(Vuex)
//arquivo de configuraçoes do vuex

//disparamos a action, ela ativa a mutations que muda o state
//a mutation precisa ter um nome, para ela ser chamada pela action e atualizar o estado
export default new Vuex.Store({
    state: {
        //queremos atualizar o id do usuario de acordo com o state dele
        //se ele esta selecionado ou nao, se esta logado ou nao
            user: {}
        },
    mutations: {

        },
    actions: {
        userStateAction: () => {
            axios.get('api/user').then(response => {
                console.log(response)
            })
            console.log('invoked')
        }
    }
})