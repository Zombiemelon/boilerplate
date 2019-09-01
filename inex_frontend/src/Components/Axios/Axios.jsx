const axios = require('axios');

const instance = axios.create({
    baseURL: 'http://localhost:8001/',
    timeout: 5000,
    headers: {
        'Access-Control-Allow-Origin': '*',
    },
});

export default instance;