import axios from 'axios';
import { defineStore } from 'pinia';

export const useProductsStore = defineStore('products', {
    state: () => ({
        products: [],
    }),
    actions: {
        load(queryString = null) {
            let url = '/api/v1/products';

            if(queryString) {
                url += '?' + queryString
            }

            return axios.get(url).then(response => this.products = response.data.data);
        }
    }
});
