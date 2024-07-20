import {useLoading} from 'vue-loading-overlay'
let $loading = useLoading({
    // options
});
export default function (axiosInstance){
    let loader = null;

    return {
        showLoader(){
            loader = $loading.show({ });
        },
        hideLoader(){
            loader.hide();
        },
        async getData(url){
            let data = [];
            await axiosInstance.get(`/${url}`)
                .then(response => {
                    data = response.data.data;
                });
            return data;
        },
        async searchData(searchQuery) {
            let url = 'issues?';
            if (searchQuery.id) {
                url += `issue_id=${searchQuery.id}&`;
            }
            if (searchQuery.status_id) {
                url += `status_id=${searchQuery.status_id}&`;
            }
            if (searchQuery.project_id) {
                url += `project_id=${searchQuery.project_id}&`;
            }
            if (searchQuery.order_by) {
                url += `sort=${searchQuery.order_by}&`;
            }
            if (searchQuery.page) {
                url += `page=${searchQuery.page}&`;
            }
            if (searchQuery.per_page) {
                url += `per_page=${searchQuery.per_page}&`;
            }
            return await this.getData(url);
        },
    }
}


