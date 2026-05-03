import { onMounted, ref, computed } from "vue";
import { useFocusStore } from "../stores/useFocusStore";
import { getSettings } from "../services/FocusService";

export function useFocusPiece() {
    const focusStore = useFocusStore()
    const isLoading = ref(true)
    const showModal = ref(false)
    const settings = getSettings()
    const timeLeft = ref(settings.minutes * 60 + settings.seconds)
    let interval = null

    const display = computed(() => {
        const m = Math.floor(timeLeft.value / 60)
        const s = timeLeft.value % 60
        return `${m < 10 ? '0' + m : m}:${s < 10 ? '0' + s : s}`
    })

    function startTimer() {
        clearInterval(interval)
        timeLeft.value = settings.minutes * 60 + settings.seconds
        interval = setInterval(() => {
            timeLeft.value--
            if (timeLeft.value <= 0) {
                clearInterval(interval)
                focusStore.next()
                startTimer()
            }
        }, 1000)
    }

    onMounted(async () => {
        await focusStore.initialize(getSettings())
        isLoading.value = false
        startTimer()
    })

    return { focusStore, isLoading, showModal, display }
}