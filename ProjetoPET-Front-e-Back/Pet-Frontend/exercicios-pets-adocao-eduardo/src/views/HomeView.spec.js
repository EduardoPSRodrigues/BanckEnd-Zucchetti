import { mount } from "@vue/test-utils";
import { describe, expect, it } from "vitest";
import Home from './HomeView.vue'

describe("Tela Home", () => {
   it("Espera-se que a tela seja renderizada",  () => {

    const component = mount(Home)

    expect(component).toBeTruthy()

   })
})