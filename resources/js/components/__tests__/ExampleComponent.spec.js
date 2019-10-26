import ExampleComponent from "../ExampleComponent";
import {mount} from "@vue/test-utils";

describe('ExampleComponent', () => {
    it('has the dumb', () => {
        const wrapper = mount(ExampleComponent);

        expect(wrapper).toEqual(wrapper);
    });
});
