import {shallowMount} from '@vue/test-utils';
import ExampleComponent from '../ExampleComponent';

describe("ExampleComponent", () => {
   it("Mounts", () => {
        const wrapper = shallowMount(ExampleComponent);
        expect(wrapper.vm).toBeTruthy();
   });
});
