import { ref, onMounted, onUnmounted, watch } from "vue";
import mediumZoom from "medium-zoom";

const zoomInstance = ref(null);

export function useZoom() {
    const initZoom = () => {
        if (!zoomInstance.value) {
            zoomInstance.value = mediumZoom({
                background: "rgba(0, 0, 0, 0.8)",
                margin: 20,
            });
        }
        zoomInstance.value.detach(); // Prevent duplicate bindings
        zoomInstance.value.attach("[data-zoomable]");
    };

    onMounted(initZoom);
    onUnmounted(() => {
        zoomInstance.value?.detach();
    });

    // Reapply zoom if content changes
    watch(zoomInstance, () => {
        initZoom();
    });

    return { initZoom };
}
