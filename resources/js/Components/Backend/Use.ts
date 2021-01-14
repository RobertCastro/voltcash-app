




import { reactive, toRefs } from "@vue/composition-api";

const state = reactive({
    isOpen: false,
});

export function useSidebar() {
    return {
        ...toRefs(state),
    };
}
