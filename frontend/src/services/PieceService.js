import { useRoute } from 'vue-router';
import axiosClient from '../axios';

export async function loadPieces() {
    try {
        const pieces = (await axiosClient.post('/index')).data.data.pieces;
        console.log(pieces);

        return pieces
    } catch (err) {
        console.log(err);

    }
}


export async function search(filters) {
    try {
        const pieces = (await axiosClient.post('/index', filters)).data.data.pieces;
        console.log(pieces);

        return pieces
    } catch (err) {
        console.log(err);

    }
    console.log(filters);

}