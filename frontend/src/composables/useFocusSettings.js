import { ref } from "vue";

export function useFocusSettings() {
    const MINUTES = ref(1)
    const SECONDS = ref(0)
    const TAGS = [
        "Design", "Engineering", "Product", "Marketing", "Research", "Data", "Security", "Infrastructure",
        "Critical", "High", "Medium", "Low", "Backlog",
        "In progress", "Needs review", "Blocked", "Done", "Archived",
        "Frontend", "Backend", "Mobile", "DevOps", "QA", "Design Ops"
    ];
    return {MINUTES, SECONDS, TAGS}
}