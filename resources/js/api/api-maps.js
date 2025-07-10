import axios from 'axios';
const API_URL = `https://gis-pemetaan-penduduk-production-fa51.up.railway.app/data`;

export async function getMaps(tahun = '') {
    console.log("app url: ",API_URL)

    return axios.get(`${API_URL}/data-penduduk`)
        .then(response => response.data)
        .catch(error => {
        console.error('Error fetching maps:', error);
        throw error;
        });
}

export async function getKecamatan(){
    return axios.get(`${API_URL}/data-kecamatan`).then(response => response.data)
    .catch(error => {
        console.error('Error fetching kecamatan:', error);
        throw error;
    });
}

export async function getDetailKecamatan(id){
    try{
        const response = await axios.get(`${API_URL}/kecamatan/` + id);
        return response.data;
    }catch(err){
        console.error('Error fetching detail kecamatan:', err);
    }
}
