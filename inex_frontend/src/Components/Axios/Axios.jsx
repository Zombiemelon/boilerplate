const axios = require('axios');

const instance = axios.create({
    baseURL: 'http://52.58.32.133:8001/',
    timeout: 5000,
    headers: {
        'Access-Control-Allow-Origin': '*',
    },
});

export default instance;