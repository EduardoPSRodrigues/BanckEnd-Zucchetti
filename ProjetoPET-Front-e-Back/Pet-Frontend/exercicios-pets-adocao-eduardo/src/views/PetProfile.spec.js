import { flushPromises, mount } from "@vue/test-utils";
import { describe, expect, it, vi } from "vitest";
import PetProfile from './PetProfile.vue'
import PetService from "@/services/PetService";

describe("Tela de perfil do pet", () => {

    const mockRoute = {
        params: {
            id: 1
        }
    }

    vi.spyOn(PetService, 'getOnePet')
        .mockResolvedValue({
            "id": 16,
            "name": "Totó",
            "age": 12,
            "weight": "8.4",
            "size": "MEDIUM",
            "race": {
                "id": 2,
                "name": "PITBULL",
            },
            "specie": {
                "id": 1,
                "name": "Gato",
            }
        })

    it("Espera-se que a tela seja renderizada", () => {
        const component = mount(PetProfile, {
            global: {
                mocks: {
                    $route: mockRoute
                }
            }
        })

        expect(component).toBeTruthy()
    })

    it("Espera-se que exiba as informações do pet", async () => {
        const component = mount(PetProfile, {
            global: {
                mocks: {
                    $route: mockRoute
                }
            }
        })

        await flushPromises()

        expect(component.text()).toContain("Amigo: Totó")
        expect(component.text()).toContain("Raça: PITBULL")
        expect(component.text()).toContain("IDADE: 12 ANO(S)")
        expect(component.text()).toContain("Peso: 8.4 KG")
        expect(component.text()).toContain("Porte: MEDIUM")
    })


    it("Espera-se que ao submeter o formulário, seja enviado os dados corretamente", async () => {

        const adoptPet = vi.spyOn(PetService, 'adoptPet').mockResolvedValue({})

        const component = mount(PetProfile, {
            global: {
                mocks: {
                    $route: mockRoute
                }
            }
        })

        await flushPromises()

        component.get("[data-test='input-name']").setValue("Dona Maria")
        component.get("[data-test='input-contact']").setValue("4002-8922")
        component.get("[data-test='input-email']").setValue("donamaria@gmail.com")
        component.get("[data-test='textarea-observations']").setValue("gosto de gato")
        component.get("[data-test='submit-button']").trigger("submit")

        expect(adoptPet).toBeCalledWith({
            name: 'Dona Maria',
            email: 'donamaria@gmail.com',
            contact: '4002-8922',
            observations: 'gosto de gato'
        })
    })

})