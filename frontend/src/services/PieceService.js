import axiosClient from '../axios';

export async function loadPieces() {    
    try {
        const pieces = (await axiosClient.get('/index')).data.data.pieces;
        return pieces
    } catch (err) {
        console.log(err);

    }
}