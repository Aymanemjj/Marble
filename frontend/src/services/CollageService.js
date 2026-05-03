import axiosClient from "../axios";
import router from "../router";

export function editCollage(id){
    router.push(`/collage/${id}/edit`)
}


export async function deleteCollage(id) {
    try {
        await axiosClient.delete(`/collage/${id}/delete`);
        return router.push('/')
    } catch (err) {
        console.log(err);

    }
}