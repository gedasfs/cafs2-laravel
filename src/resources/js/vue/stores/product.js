import axios from 'axios';
import { defineStore } from 'pinia';

export const useProductStore = defineStore('product', {
    state: () => ({
        id: null,
        name: null,
        code: null,
        price: null,
        category_id: null,
        description: null,

    }),
    actions: {
        find(id) {
            return axios.get(`/api/v1/products/${id}`).then(response => Object.assign(this, response.data.data));
        },

        save() {
            let url = '/api/v1/products';

            if (this.id) {
                url += `/${this.id}/update`;
            } else {
                url += '/store';
            }

            return axios({
                method: this.id ? 'patch' : 'post',
                url: url,
                data: this,
            }).then(response => Object.assign(this, response.data.data));
        }
    }
});
