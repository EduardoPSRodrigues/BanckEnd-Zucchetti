import { describe, expect, it, vi } from 'vitest'
import Login from './Login.vue'
import { flushPromises, mount } from '@vue/test-utils'

import AuthenticationService from '../services/AuthenticationService'

/*
FAZER ISSO SOMENTE SE FOR USAR VUETIFY 
*/
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives,
})

global.ResizeObserver = require('resize-observer-polyfill')

describe('Tela de login', () => {

    it('Espera-se que a tela seja renderizada', () => {
        const component = mount(Login, {
            //Habilitando o plugin do vuetify
            global: {
                plugins: [vuetify]
            }
        })
        expect(component).toBeTruthy()
    })

    it('Espera-se que ao submeter o formulário, seja redirecionado para tela home', () => {

        /*O teste não precisa da API para funcionar, como eu sei a resposta da API, então estou gerando
        um dado de resposta da API e colocando no teste unitário. Pois quando clicar para fazer o login, 
        será disparado a função AuthenticationService e preciso passar essas informações.*/
        const login = vi.spyOn(AuthenticationService, 'login').mockResolvedValue({
            data: {
                token: 'token',
                permissions: []
            }
        })

        const component = mount(Login, {
            global: {
                plugins: [vuetify]
            }
        })

        /* GET quando for algo nativo do html
        getComponent quando for um componente externo, exemplo vuetify
        Não precisa ser o e-mail que esta no banco de dados, pode ser qualquer informação que o teste irá funcionar*/
        component.getComponent("[data-test='input-email']").setValue("h@gmail.com")
        component.getComponent("[data-test='input-password']").setValue("12345678")
        component.getComponent("[data-test='submit-button']").trigger("submit")
        
        expect(login).toBeCalledTimes(1) //Testar se o método foi chamado apenas uma vez
        expect(login).toBeCalledWith({email: 'h@gmail.com', password:  '12345678'}) //Ao clicar no botão submit eu espero que seja passado o email e a senha que esta preenchido no formulário

    })
    
    //Para usar o await tem que usar o async
    it('Espera-se que ao submeter o formulário, receba uma mensagem de erro', async () => {

        vi.spyOn(AuthenticationService, 'login').mockRejectedValue(new Error()) //Vai rejeitar o login e trazer uma mensagem de erro genérica

        const component = mount(Login, {
            global: {
                plugins: [vuetify]
            }
        })

        // GET quando for algo nativo do html
        // getComponente quando for um componente externo
        component.getComponent("[data-test='input-email']").setValue("h@gmail.com")
        component.getComponent("[data-test='input-password']").setValue("12345678")
        component.getComponent("[data-test='submit-button']").trigger("submit")
        
        await flushPromises() //A msg demora para aparecer e para isso tem que usar esse codigo para aguardar a msg e verificar o seu valor, o teste é assincrono
        
        expect(component.text()).toContain("Houve um erro ao realizar o login")
    })

})