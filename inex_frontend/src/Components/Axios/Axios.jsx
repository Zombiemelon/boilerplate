const axios = require('axios');

const apiToken = JSON.parse(localStorage.getItem('api_token'));

const instance = axios.create({
    baseURL: `inex_back:8001`,
    timeout: 50000,
    headers: {
        'Access-Control-Allow-Origin': '*',
        'Authorization': `Bearer ${apiToken}`
    },
});

export default instance;