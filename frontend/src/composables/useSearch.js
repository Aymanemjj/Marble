import { onMounted, ref, watch } from 'vue';
import router from '../router';
import { useAxiosRequest } from './useAxiosRequest';



export function useSearch() {

    //SubMenus Stat
    const open = ref(false)
    const create = ref(false)
    const searchBar = ref(false)
    const tags = ref(null)
    //Search inputs
    const filters = ref({
        search: null,
        tags: null
    })

    function filter() {

        router.push({
            name: 'Home',
            query: {
                search: filters.value.search,
                tags: filters.value.tags
            }
        })
    }

    onMounted(async()=>{
        tags.value = (await useAxiosRequest('get', 'tags/list', false)).data.tags
    })


    function resetSearch() {
        router.replace({ query: {} });
    }

    async function search(filters) {
        try {
            const pieces = (await axiosClient.post('/index', filters)).data.data.pieces;
            items.value = pieces
            return items
        } catch (err) {
            console.log(err);

        }

    }


    return {
        open,
        searchBar,
        filters,
        filter,
        resetSearch,
        search,
        create,
        tags
    }
}