import { useRoute } from 'vue-router';
import axiosClient from '../axios';

export async function loadPieces(filters) {


        

    try {
        const pieces = (await axiosClient.post('/index',filters)).data.data.pieces;

        return pieces
    } catch (err) {
        console.log(err);

    }
}


