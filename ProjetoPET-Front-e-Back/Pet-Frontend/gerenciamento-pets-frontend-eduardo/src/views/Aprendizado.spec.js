//describe é o título do teste
//it faz a descrição da tarefa do teste
import { describe, expect, it } from 'vitest'
//mount vai montar o componente para realizar o teste
import { flushPromises, mount } from "@vue/test-utils";

//Importar a tela de aprendizado
import Aprendizado from './Aprendizado.vue'

describe("Testa a tela de aprendizado", () => {

    it('Espera-se que a tela seja renderizada', () => {
        /* Irei passar o componente que vai montar a tela que quero testar
        Se o teste falhar é porque deu ruim
        Instalar a biblioteca npm i -D @viteste/coverage-v8
        Para executar o teste digita no terminar npm run teste:unit */
        const component = mount(Aprendizado)
        //Espara que a renderizar o componente seja verdadeiro
        expect(component).toBeTruthy()
    })

    it('Espera-se que ao submeter o formulário, o item seja adicionado para a lista', async () => {
        const component = mount(Aprendizado)
        // Busca o elemento na pagina Aprendizado e coloca um valor nesse input
        component.get("[data-test='input-description']").setValue("Estudar vue")
        // Busca o elemento na pagina Aprendizado e clica no botão de cadastrar
        component.get("[data-test='submit-button']").trigger("submit")

        //Toda vez que uma ação alterar um estado e for assincrono, tem que colocar esse comando 
        await flushPromises()

        const list = component.get("[data-test='list']")

        //Verificou se dentro da lista tem um texto Estudar vue
        expect(list.text()).toContain("Estudar vue")
    })

    it('Espera-se que ao submeter o formulário, o item não seja adicionado', async () => {
        const component = mount(Aprendizado)
        // Busca um elemento no componente
        component.get("[data-test='input-description']").setValue("abc")
        // clicando no botão de cadastrar
        component.get("[data-test='submit-button']").trigger("submit")

        await flushPromises()

        //Verificando se apareceu a mensagem de erro
        expect(component.text()).toContain("A descrição é pequena demais.")

        const list = component.get("[data-test='list']")

        //Espera-se que na lista não contenha o texto abc pois é pequeno demais
        expect(list.text()).not.toContain("abc")
    })

})