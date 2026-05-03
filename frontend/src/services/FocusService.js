import { useAxiosRequest } from "../composables/useAxiosRequest"

export async function initializeFocus(data) {
    sessionStorage.setItem('focus_settings', JSON.stringify(data))
}

export function getSettings() {
    return JSON.parse(sessionStorage.getItem('focus_settings'))
    
}

export function getPieces() {
    return JSON.parse(sessionStorage.getItem('focus_pieces'))
}

export function stop() {
    sessionStorage.removeItem('focus_settings')
    sessionStorage.removeItem('focus_pieces')
}





