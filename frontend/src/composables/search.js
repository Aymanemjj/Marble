import {ref, watch } from 'vue';
import router from '../router';



export function useSearch() {

    //SubMenus Stat
    const open = ref(false)
    const searchBar = ref(false)

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

/*     watch(filters, ()=>{

    })
 */
    return {
        open,
        searchBar,
        filters,
        filter,
        resetSearch,
        search
    }
}