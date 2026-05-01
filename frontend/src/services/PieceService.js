import { useRoute } from 'vue-router';
import axiosClient from '../axios';
import router from '../router';

export async function loadPieces(filters) {

    try {
        const pieces = (await axiosClient.post('/index', filters)).data.data.pieces;

        return pieces
    } catch (err) {
        console.log(err);

    }
}
export async function deletePiece(id) {
    try {
        await axiosClient.delete(`/piece/${id}/delete`);
        return router.push('/')
    } catch (err) {
        console.log(err);

    }
}


export function editPiece(id){
    router.push(`${id}/edit`)
}