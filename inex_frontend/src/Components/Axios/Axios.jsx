const axios = require('axios');

const instance = axios.create({
    baseURL: `${process.env.API_URL}`,
    timeout: 50000,
    headers: {
        'Access-Control-Allow-Origin': '*',
    },
});

export default instance;