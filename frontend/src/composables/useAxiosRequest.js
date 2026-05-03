import axiosClient from "../axios";

export async function useAxiosRequest(HTTPVerb, destination, data) {
    try {
        let res = null
        data
            ? res = (await axiosClient[HTTPVerb](`${destination}`,data)).data

            : res = (await axiosClient[HTTPVerb](`${destination}`)).data
        console.log(res);
        
            return res
    } catch (err) {
        console.log(err);
        
    }
}