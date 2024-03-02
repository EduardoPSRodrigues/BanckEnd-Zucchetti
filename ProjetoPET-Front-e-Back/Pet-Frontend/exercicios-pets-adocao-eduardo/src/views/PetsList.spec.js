import { flushPromises, mount } from "@vue/test-utils";
import { describe, expect, it, vi } from "vitest";
import PetsList from './PetsList.vue'
import PetService from "@/services/PetService";

describe("Tela de listagem de pets", () => {

    vi.spyOn(PetService, 'getAllPets').mockResolvedValue([
        {
            id: 1,
            pet_name: "Dog",
            age: 12
        },
        {
            id: 2,
            pet_name: "Cat",
            age: 2
        },
        {
            id: 3,
            pet_name: "Cacau",
            age: 3
        }
    ])

    it("Espera-se que a tela seja renderizada", () => {

        const component = mount(PetsList)

        expect(component).toBeTruthy()

    })

    it("Espera-se que liste um card para cada pet", async () => {

        const component = mount(PetsList)

        await flushPromises()

        expect(component.text()).toContain("Dog")
        expect(component.text()).toContain("Cat")

        expect(component.findAll("[data-test='item-pet']")).toHaveLength(3)
    })


    it("Espera-se que navegue para a tela de perfil do pet clicado", async () => {

        const mockRouter = {
            push: vi.fn()
        }

        const component = mount(PetsList, {
            global: {
                mocks: {
                    $router: mockRouter
                }
            }
        })

        await flushPromises()

        component.findAll("[data-test='item-pet']")[0].trigger("click")

        expect(mockRouter.push).toHaveBeenCalledWith('/pets-adocao/1/perfil')
        
    })
})